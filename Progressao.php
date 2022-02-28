<?php

require_once("Auxiliar.php");
require_once("defines.php");


class Progressao extends Auxiliar
{

    // Recebe os termos da Progressao.
    private $term = [];

    // Recebe o valor da razão dos termos.
    private $razao;

    /**
     * Construtor da class inicializa os termos da Progressao.
     * Como parâmetro recebe os termos do array.
     * @param $termos (array)
     */

    public function __construct($termos = [])
    {
        $this->term = $termos;
        if ($this->term[0] != "" || $this->term[0] != "")
            $this->razao = $this->term[1] - $this->term[0];
    }

    /**
     * Construtor da class inicializa os termos da Progressao.
     * @param (int)
     */
    public function verificarTipoProgressao($param = TERMO_PA)
    {
        try {
            Auxiliar::isArray($param);
            switch ($param) {
                case 1:
                    $count = count($this->verificarPA());
                    return $count;
                    break;
                case 2:
                    $count = count($this->verificarPG());
                    return $count;
                    break;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    private function verificarPA()
    {
        Auxiliar::isArray($this->term);
        $razao = Auxiliar::calculaRazaoPa($this->term[0], $this->term[1]);
        for ($a = 0; $a <= count($this->term); $a++) {
            if (isset($this->term[$a + 1])) {
                Auxiliar::isNumber($this->term[$a + 1]);
                if ($this->term[$a + 1] != "" || !empty($this->term[$a + 1])) {
                    $checaRazao = $this->term[$a + 1] - $this->term[$a];
                    if ($checaRazao == $razao) {
                        $isPa[] = 'isPa';
                    } else {
                        $isPa[] = 'isNoPA';
                    }
                }
            }
        }
        $isPa = array_unique($isPa);
        return $isPa;
    }


    private function verificarPG()
    {
        Auxiliar::isArray($this->term);
        Auxiliar::checaZero($this->term[0], $this->term[1]);
        $razao = $this->term[1] / $this->term[0];
        for ($a = 0; $a <= count($this->term); $a++) {
            if (isset($this->term[$a + 1])) {
                Auxiliar::isNumber($this->term[$a + 1]);
                if ($this->term[$a + 1] != "" || !empty($this->term[$a + 1])) {
                    $checaRazao = $this->term[$a + 1] / $this->term[$a];
                    if ($checaRazao == $razao) {
                        $isPg[] = 'isPG';
                    } else {
                        $isPg[] = 'isNoPG';
                    }
                }
            }
        }
        $isPg = array_unique($isPg);
        return $isPg;
    }
    /**
     * Soma os termos de uma PA.
     */
    public function somaTermosPA()
    {
        Auxiliar::isArray($this->term);
        $nTermos = count($this->term);
        $ultimoTermo = $this->verificarUltimoTermo();
        $calculo = (($this->term[0] + $ultimoTermo) * $nTermos) / 2;
        return $calculo;
    }
    /**
     * Calcula o eNesimo termo da PA.
     */
    public function calculaNtermo($nTermo)
    {
        $calculo = $this->term[0] + ($nTermo - 1) * $this->razao;
        return $calculo;
    }

    /**
     * Verifica o último termo da Progressão.
     */
    private function verificarUltimoTermo()
    {
        Auxiliar::isArray($this->term);
        for ($b = 0; $b <= count($this->term); $b++) {
            $ultimo = count($this->term) - 1;
            if ($b == $ultimo) {
                return $this->term[$b];
            }
        }
    }
}



$objeto = new Progressao(['']);
$tipoProgressao = $objeto->verificarTipoProgressao(TERMO_PA);
$tipo = TERMO_PA;
$verificarTipo = $tipo == 1 ? "PA" : "PG";
if ($tipoProgressao == 1) {
    echo "É uma " . $verificarTipo;
} else {
    echo "Não é uma " . $verificarTipo;
}
