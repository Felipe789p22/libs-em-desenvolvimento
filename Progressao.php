<?php

require_once("Auxiliar.php");
require_once("defines.php");

class Progressao extends Auxiliar
{

    // Recebe os termos da Progressao.
    private $term = [];

    /**
     * Construtor da class inicializa os termos da Progressao.
     */

    public function __construct($termos = [])
    {
        $this->term = $termos;
    }

    public function processar($param = TERMO_PA)
    {
        try {

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
        // $razao = $this->term[1] - $this->term[0];
        $razao = Auxiliar::calculaRazaoPa($this->term[0],$this->term[1]);
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

    public function calculaNtermo(){

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



// $objeto = new Progressao([2, 4, 6, 8, 10, 12, 14, 16, 18, 20, 22, 24, 26, 28, 30, 32, 34, 36, 38, 40]);
$objeto = new Progressao([0, 1, 2, 3, 4,5]);
$merges = $objeto->processar(TERMO_PA);
$tipo = TERMO_PA;
$verificarTipo = $tipo == 1 ? "PA" : "PG";
if ($merges == 1) {
    echo "Eh uma " . $verificarTipo;
} else {
    echo "nao eh uma " . $verificarTipo;
};

echo "<BR>soma dos termos eh " . $objeto->somaTermosPA();
