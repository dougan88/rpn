<?php

namespace App\Operation;


class PlusOperation implements TwoOperandsOperationInterface
{
    /**
     * @param float $operand1
     * @param float $operand2
     * @return float
     */
    public function execute(float $operand1, float $operand2): float
    {
        return $operand1 + $operand2;
    }
}