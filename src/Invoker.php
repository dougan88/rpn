<?php

namespace App;
use App\CommunicationInterface\CommunicationInterface;

/**
 * Invoker is using the interface given to it.
 */
class Invoker
{
    private $communicationInterface;

    /**
     * Set the communication interface.
     *
     * @param CommunicationInterface $communicationInterface
     */
    public function setCommand(CommunicationInterface $communicationInterface)
    {
        $this->communicationInterface = $communicationInterface;
    }

    /**
     * Run the communication process.
     */
    public function run()
    {
        $this->communicationInterface->processCommunication();
    }
}