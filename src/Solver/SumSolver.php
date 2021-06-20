<?php

namespace App\Solver;
use App\Solver\SolverInterface;

class SumSolver implements SolverInterface
{
    public function solve(string $expression): string
    {
        $turn = true;

        while($turn) {
            $compute = preg_replace_callback("#(\d+\+\d+)#", function ($matches) {
                if(isset($matches[1])) {
                    $expressionArray = explode('+', $matches[1]); 
                    return $expressionArray[0] + $expressionArray[1];
                }

                return $matches[0];
            }, $expression);

            if($compute !== $expression) {
                $expression = $compute;
            } else {
                $turn = false;
            }
        }

        return $expression;
    }
}