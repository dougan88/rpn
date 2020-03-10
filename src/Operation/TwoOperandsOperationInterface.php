<?php

namespace App\Operation;

interface TwoOperandsOperationInterface {
    public function execute(float $operand1, float $operand2) : float;
}