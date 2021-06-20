<?php

namespace App\Solver;

interface SolverInterface
{
    public function solve(string $expression): string;
}