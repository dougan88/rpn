<?php

namespace App\Operation;


class OperationFactory
{
    private $operationsList;

    /**
     * OperationFactory constructor.
     *
     * @param array $operationsList
     */
    public function __construct(array $operationsList)
    {
        $this->operationsList = $operationsList;
    }

    /**
     * Get operation class by it's sign.
     *
     * @param string $sign
     * @return mixed
     * @throws \Exception
     */
    public function getOperationBySign(string $sign) : TwoOperandsOperationInterface
    {
        foreach ($this->operationsList['operations'] as $operation) {
            if ($operation['sign'] === $sign) {
                return new $operation['class'];
            }
        }
        throw new \Exception('Incorrect operation');
    }

    /**
     * Get available operations.
     *
     * @return array
     */
    public function getAvailableOperations()
    {
        return array_map(function ($val) {
            return $val['sign'];
        }, $this->operationsList['operations']);
    }
}