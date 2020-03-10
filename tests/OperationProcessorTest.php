<?php

namespace App\Tests;

use App\Operation\OperationFactory;
use App\Processor\OperationProcessor;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Yaml\Yaml;

/**
 * Class OperationProcessorTest.
 *
 * @coversDefaultClass \App\Processor\OperationProcessor
 */
class OperationProcessorTest extends TestCase
{

    /**
     * @covers ::processInput
     *
     * @throws \Exception
     */
    public function testOperationProcessor()
    {
        //OperationFactory haven't been mocked here because the whole
        // OperationProcessor with it's dependencies can be considered as a unit in this context.
        $operationFactory = new OperationFactory(Yaml::parseFile('./config/operations.config.yaml'));
        $operationProcessor = new OperationProcessor($operationFactory);

        //If calculation hasn't been accomplished yet it should return null.
        $this->assertNull($operationProcessor->processInput(5));
        $this->assertNull($operationProcessor->processInput(7));

        //Check after calculation has been processed.
        $this->assertEquals(12, $operationProcessor->processInput('+'));

        $this->assertNull($operationProcessor->processInput(2));
        $this->assertEquals(10, $operationProcessor->processInput('-'));

        $this->assertNull($operationProcessor->processInput(5));
        $this->assertEquals(50, $operationProcessor->processInput('*'));

        //Check multiple operands/operations processing.
        $this->assertEquals(5, $operationProcessor->processInput('-15 7 3 15 + + + /'));

        //If there's more operations than operands an exception should be thrown.
        $this->expectException(\Exception::class);
        $operationProcessor->processInput('-');

        //Unknown operation should throw an exception.
        $this->expectException(\Exception::class);
        $operationProcessor->processInput('9 $');

        $this->assertEquals(15, $operationProcessor->processInput('10 +'));

        //More operations than operands in multiple input.
        $this->expectException(\Exception::class);
        $operationProcessor->processInput('9 + + +');
    }

}