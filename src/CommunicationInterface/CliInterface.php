<?php

namespace App\CommunicationInterface;

use App\Processor\OperationProcessorInterface;

class CliInterface implements CommunicationInterface
{
    private $operationProcessor;

    /**
     * CliInterface constructor.
     *
     * @param OperationProcessorInterface $operationProcessor
     */
    public function __construct(OperationProcessorInterface $operationProcessor)
    {
        $this->operationProcessor = $operationProcessor;
    }

    /**
     * Process communication till user will type "q" or an exception will occur.
     */
    public function processCommunication()
    {
        $input = '';

        do {
            if ($input || is_numeric($input)) {
              echo $input . PHP_EOL;
            }
            $input = readline('>');

            if ($input === 'q')
                break;

            try {
                $operationResult = $this->operationProcessor->processInput($input);
                $input = !is_null($operationResult) ? $operationResult : $input;
            } catch (\Exception $exception) {
                echo $exception->getMessage() . PHP_EOL;
                break;
            }
        } while ($input !== 'q');

    }
}