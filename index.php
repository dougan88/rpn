<?php

use App\CommunicationInterface\CliInterface;
use App\Invoker;
use App\Processor\OperationProcessor;
use Symfony\Component\Yaml\Yaml;
use App\Operation\OperationFactory;

require __DIR__ . '/vendor/autoload.php';

$operationFactory = new OperationFactory(Yaml::parseFile('./config/operations.config.yaml'));
$operationProcessor = new OperationProcessor($operationFactory);

$cliInterface = new CliInterface($operationProcessor);
$invoker = new Invoker();
$invoker->setCommand($cliInterface);
$invoker->run();

