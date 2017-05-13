<?php

namespace Php\Phprs\Calculadora;

class Soma
{
    public function getResultado($valor1 = 0, $valor2 = 0)
    {
        if (is_numeric($valor1) && is_numeric($valor2)) {
            return $valor1 + $valor2;
        }

        return false;
    }
}