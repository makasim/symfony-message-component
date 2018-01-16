<?php
namespace Symfony\Component\Message;

interface TopicSubscriberInterface
{
    public static function getSubscribedTopics(): array;
}