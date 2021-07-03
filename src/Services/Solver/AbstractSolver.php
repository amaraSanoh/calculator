<?php

namespace App\Services\Solver;

abstract class AbstractSolver
{
    const PART_OF_EXPRESSION_MATCHED = 1;
    const FIRST_OPERAND = 0;
    const SECOND_OPERAND = 1;
    const FIRST_POSITION = 0;
    const ALL_EXPRESSION = 0;

    protected string $regexNumber = '[\+\-]?([0-9]*[\.][0-9]+|[0-9]+[\.][0-9]*|[0-9]+)';
    //The regex below is a sequence of or. To understand it, you just need to read it about the following symbol | 
    protected string $regexNumberError = '#[0-9]*[\.]+[0-9]*[\.]+|[\+]+[\-]+|[\-]+[\+]+|[\/]+[\*]+|[\*]+[\/]+|[\*]+[\*]+|[\/]+[\/]+|[\-]+[\-]+|[\+]+[\+]+|[A-Za-z]+#';

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
                if(isset($matches[self::PART_OF_EXPRESSION_MATCHED])) {
                    $match = $matches[self::PART_OF_EXPRESSION_MATCHED];
                    $expressionArray = explode($this->getOperator(), $match);

                    if( strpos($matches[self::PART_OF_EXPRESSION_MATCHED], '-') === self::FIRST_POSITION || 
                        strpos($matches[self::PART_OF_EXPRESSION_MATCHED], '+') === self::FIRST_POSITION
                    ){
                        $match = substr($match, 1);
                        $expressionArray = explode($this->getOperator(), $match);
                        $expressionArray[self::FIRST_OPERAND] = substr($matches[self::PART_OF_EXPRESSION_MATCHED], 0, 1).$expressionArray[self::FIRST_OPERAND];
                        
                        $result = $this->compute(operand1 : $expressionArray[self::FIRST_OPERAND], operand2 : $expressionArray[self::SECOND_OPERAND]);  
                        return substr($result, 0, 1) !== '+' && substr($result, 0, 1) !== '-' ? '+'.$result : $result;   
                    }
                    
                    return $this->compute(operand1 : $expressionArray[self::FIRST_OPERAND], operand2 : $expressionArray[self::SECOND_OPERAND]); 
                }
                   
                return $matches[self::ALL_EXPRESSION];
            }, $expression, limit : 1);
            
            if($compute !== $expression) $expression = $compute;
            else $turn = false;
        }

        return $expression;
    }

}