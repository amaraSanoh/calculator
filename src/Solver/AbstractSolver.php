<?php

namespace App\Solver;

abstract class AbstractSolver
{
    protected string $regexNumber = '[\+\-]?([0-9]*[\.][0-9]+|[0-9]+[\.][0-9]*|[0-9]+)';
    protected string $regexNumberError = '#[0-9]*[\.]+[0-9]*[\.]+#';

    protected abstract function getOperator(): string;
    protected abstract function compute(string $operand1, string $operand2): string;
    protected abstract function getRegex(): string;

    public function solve(string $expression): string
    {
        if(preg_match($this->regexNumberError, $expression) || preg_match($this->regexNumberError, $expression))
            throw new \Exception('Operand malformed');
            
        $turn = true;

        while($turn) {
            $compute = preg_replace_callback($this->getRegex(), function ($matches) {
                if(isset($matches[1])) {
                    $match = $matches[1];
                    $expressionArray = explode($this->getOperator(), $match);

                    if(strpos($matches[1], '-') === 0 || strpos($matches[1], '+') === 0) {
                        $match = substr($match, 1);
                        $expressionArray = explode($this->getOperator(), $match);
                        $expressionArray[0] = substr($matches[1], 0, 1).$expressionArray[0];
                        
                        $result = $this->compute(operand1 : $expressionArray[0], operand2 : $expressionArray[1]);  
                        return substr($result, 0, 1) !== '+' && substr($result, 0, 1) !== '-' ? '+'.$result : $result;   
                    }
                    
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