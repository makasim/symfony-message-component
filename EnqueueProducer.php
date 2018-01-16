<?php
namespace Symfony\Component\Message;

use Enqueue\Client\ProducerInterface as EnqueueClientProducer;
use Enqueue\Client\Message as EnqueueMessage;

class EnqueueProducer implements Producer
{
    /**
     * @var EnqueueClientProducer
     */
    private $enqueueProducer;

    public function __construct(EnqueueClientProducer $enqueueProducer)
    {
        $this->enqueueProducer = $enqueueProducer;
    }

    public function sendEvent($topic, $message)
    {
        $this->enqueueProducer->sendEvent($topic, $this->convertMessage($message));
    }

    public function sendCommand($command, $message)
    {
        $this->enqueueProducer->sendCommand($command, $this->convertMessage($message));
    }

    private function convertMessage(Message $message): EnqueueMessage
    {
        // TODO convert logic here.

        return new EnqueueMessage();
    }
}