<?php

namespace App\Services\Solver;
use App\Services\Solver\{DivisionSolver, MultiplicationSolver, SumSolver, SubstractionSolver};

class Calculator
{
    public function __construct(
        private DivisionSolver $divisionSolver,
        private MultiplicationSolver $multiplicationSolver,
        private SumSolver $sumSolver,
        private SubstractionSolver $substractionSolver
    ) {}

    public function compute(string $expression): string
    {
        try {
            $compute = $this->divisionSolver->solve($expression);
            $compute = $this->multiplicationSolver->solve($compute);
            $compute = $this->sumSolver->solve($compute);
            $compute = $this->substractionSolver->solve($compute);
            return substr($compute, 0, 1) === '+' ? substr($compute, 1) : $compute;

        } catch(\Exception $e) {
            return $e->getMessage();
        }
    }
}