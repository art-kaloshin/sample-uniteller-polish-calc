<?php

class PolishCalc implements CalcInterface
{
    const WRONG_EXPRESSION = 'Wrong expression';
    const DIVISION_BY_ZERO = 'Division by zero';

    const OPERATOR_VS_OPERAND_ARRAY = [
        '^' => 2,
        '-' => 2,
        '+' => 2,
        '/' => 2,
        '*' => 2,
        'sin' => 1,
        'cos' => 1
    ];

    private string $expression;

    public function setExpression(string $expression): CalcInterface
    {
        $this->expression = $expression;
        return $this;
    }

    /**
     * @throws Exception
     */
    public function getResult(): float
    {
        $expression = explode(' ', $this->expression);
        $index = 0;
        $a = 0;

        while (count($expression) > 1 && $index < count($expression)) {
            if (in_array($expression[$index], array_keys(self::OPERATOR_VS_OPERAND_ARRAY))) {
                $operator = $expression[$index];
                $operandCount = self::OPERATOR_VS_OPERAND_ARRAY[$operator];

                if ($index < $operandCount) {
                    throw new Exception(self::WRONG_EXPRESSION);
                }

                $operandCount > 1 && $a = $expression[$index - 2];
                $b = $expression[$index - 1];

                $result = match ($expression[$index]) {
                    '^' => $this->calcPow($a, $b),
                    '-' => $this->calcMinus($a, $b),
                    '+' => $this->calcPlus($a, $b),
                    '*' => $this->calcMultiply($a, $b),
                    '/' => $this->calcDivision($a, $b),
                    'sin' => $this->calcSinus($b),
                    'cos' => $this->calcCos($b),
                    default => throw new Exception(self::WRONG_EXPRESSION),
                };

                $expression[$index - $operandCount] = $result;
                $index = $index - $operandCount;
                array_splice($expression, $index + 1, $operandCount);
            } else {
                $index++;
            }
        }

        if (count($expression) > 1 || $index >= count($expression)) {
            throw new Exception(self::WRONG_EXPRESSION);
        }

        return floatval(array_pop($expression));
    }

    private function calcMinus(float $a, float $b): float
    {
        return $a - $b;
    }

    private function calcPlus(float $a, float $b): float
    {
        return $a + $b;
    }

    private function calcMultiply(float $a, float $b): float
    {
        return $a * $b;
    }

    /**
     * @throws Exception
     */
    private function calcDivision(float $a, float $b): float
    {
        $b == 0 && throw new Exception(self::DIVISION_BY_ZERO);
        return $a / $b;
    }

    private function calcSinus(float $b): float
    {
        return sin(deg2rad($b));
    }

    private function calcCos(float $b): float
    {
        return cos(deg2rad($b));
    }

    private function calcPow(int | string $a, string $b): float
    {
        return pow($a, $b);
    }

}