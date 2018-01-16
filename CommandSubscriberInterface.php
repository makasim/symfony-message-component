<?php
namespace Symfony\Component\Message;

interface CommandSubscriberInterface
{
    public static function getSubscribedCommands(): array;
}