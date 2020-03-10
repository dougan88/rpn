<?php

namespace App\Processor;


interface OperationProcessorInterface
{
    public function processInput(string $input) : ?float;
}