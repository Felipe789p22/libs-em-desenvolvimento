<?php

/**
 * Classe auxiliar efetua pequenos calculos.
 */
class Auxiliar
{


    public static function isNumber($number)
    {
        if (!is_numeric($number)) {
            throw new Exception("A sequencia de caracteres nao e numerica");
        }
    }

    public static function isArray($valor)
    {
        if (!is_array($valor)) {
            throw new Exception("Insira dados válidos");
        }
    }
    public static function checaZero($termo1,$termo2)
    {
        if ($termo1== 0 || $termo2 == 0) {
            throw new Exception("Dados invalidos divisao por zero");
        }
    }
    public static function calculaRazaoPa($p1,$p2)
    {
        $razao = $p2 - $p1;
        return $razao;
    }
}
