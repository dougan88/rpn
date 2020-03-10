<?php

namespace App\Processor;

use App\Operation\OperationFactory;

class OperationProcessor implements OperationProcessorInterface
{

    private $operandsStack;

    private $operationsQueue;

    private $operationFactory;

    private $availableOperationsList;

    /**
     * OperationProcessor constructor.
     *
     * @param OperationFactory $operationFactory
     */
    public function __construct(OperationFactory $operationFactory)
    {
        $this->operationFactory = $operationFactory;
        $this->availableOperationsList = $this->operationFactory->getAvailableOperations();
        $this->operandsStack = new \SplStack();
        $this->operandsStack->setIteratorMode(\SplDoublyLinkedList::IT_MODE_LIFO);
        $this->operationsQueue = new \SplQueue();
        $this->operationsQueue->setIteratorMode(\SplQueue::IT_MODE_DELETE);
    }

    /**
     * Return calculated value if possible, otherwise null.
     *
     * @param string $input
     * @return float|null
     * @throws \Exception
     */
    public function processInput(string $input): ?float
    {
        $input = explode(' ', $input);

        foreach ($input as $item) {
            if (is_numeric($item)) {
                $this->operandsStack->push($item);
            } elseif (in_array($item, $this->availableOperationsList)) {
                $this->operationsQueue->enqueue($item);

            } else {
                throw new \Exception('Unknown operation');
            }
        }

        return $this->operationsQueue->count()
            ? $this->processOperations()
            : null;
    }

    /**
     * Calculate currently available values.
     *
     * @return float
     * @throws \Exception
     */
    private function processOperations() : ?float
    {
        $this->operandsStack->rewind();
        $this->operationsQueue->rewind();

        $result = null;
        foreach ($this->operationsQueue as $operationSign) {
            $operation = $this->operationFactory->getOperationBySign($operationSign);
            $operand2 = $this->operandsStack->pop();
            $operand1 = $this->operandsStack->pop();
            $result = $operation->execute($operand1, $operand2);
            $this->operandsStack->push($result);
        }

        return $result;
    }
}