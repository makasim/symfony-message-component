<?php
namespace Symfony\Component\Message;

interface Producer
{
    /**
     * @param string               $topic
     * @param string|array|Message $message
     */
    public function sendEvent($topic, $message);

    /**
     * @param string               $command
     * @param string|array|Message $message
     *
     * TODO add reply support
     */
    public function sendCommand($command, $message);
}