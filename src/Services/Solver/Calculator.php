<?php

namespace App\Services\Solver;

use App\Services\Solver\{
    CalculatorInterface,
    DivisionSolver,
    MultiplicationSolver,
    SumSolver,
    SubstrationSolver
};


class Calculator implements CalculatorInterface
{
    protected DivisionSolver $divisionSolver;
    protected MultiplicationSolver $multiplicationSolver;
    protected SumSolver $sumSolver;
    protected SubstractionSolver $substractionSolver;

    public function __construct() {
        $this->divisionSolver = new DivisionSolver();
        $this->multiplicationSolver = new MultiplicationSolver();
        $this->sumSolver = new SumSolver();
        $this->substractionSolver = new SubstractionSolver();
    }

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