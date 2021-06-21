<?php

namespace App\Solver;
use App\Solver\AbstractSolver;

class DivisionSolver extends AbstractSolver
{
    protected function getOperator(): string
    {
       return '/';
    }

    protected function compute(string $operand1, string $operand2): string
    {
        return strval(floatval($operand1) / floatval($operand2));
    }

    protected function getRegex(): string
    {
        return "#(".$this->regexNumber."\/".$this->regexNumber.")#";
    }
}