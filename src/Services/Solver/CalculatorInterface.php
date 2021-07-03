<?php

namespace App\Services\Solver;

interface Calculatorinterface
{

    public function compute(string $expression): string;
}