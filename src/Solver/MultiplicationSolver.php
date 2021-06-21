<?php

namespace App\Solver;
use App\Solver\AbstractSolver;

class MultiplicationSolver extends AbstractSolver
{
    protected function getOperator(): string
    {
       return '*';
    }

    protected function compute(string $operand1, string $operand2): string
    {
        return $operand1 * $operand2;
    }

    protected function getRegex(): string
    {
        return "#(\d+\*\d+)#";
    }
}