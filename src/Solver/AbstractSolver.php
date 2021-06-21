<?php

namespace App\Solver;

abstract class AbstractSolver
{
    protected string $regexNumber = '[\+\-]?([0-9]+[\.][0-9]+|[0-9]+)';

    protected abstract function getOperator(): string;
    protected abstract function compute(string $operand1, string $operand2): string;
    protected abstract function getRegex(): string;

    public function solve(string $expression): string
    {
        $turn = true;

        while($turn) {
            $compute = preg_replace_callback($this->getRegex(), function ($matches) {
                if(isset($matches[1])) {
                    $expressionArray = explode($this->getOperator(), $matches[1]); 
                    return $this->compute(operand1 : $expressionArray[0], operand2 : $expressionArray[1]);          
                }
                    
                return $matches[0];
            }, $expression, limit : 1);
            
            if($compute !== $expression) $expression = $compute;
            else $turn = false;
        }

        return $expression;
    }

}