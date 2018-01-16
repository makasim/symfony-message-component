# Publish message

```php
<?php
use Symfony\Component\Message\Message;
use Symfony\Component\Message\EnqueueProducer;
use Enqueue\SimpleClient\SimpleClient;

$enqueueClient = new SimpleClient('amqp:');
$producer = new EnqueueProducer($enqueueClient->getProducer($setupBroker = true));

$message = new Message('theBody');

// one to many or fire and forget
$producer->sendEvent('user_updated', $message);

// one to one with optional reply (not implemented)
$producer->sendCommand('send_registration_email', $message);
```

# Consuming messages.

the processors could be shared and used with any queue interop compatible consumer.

```php
<?php

use Interop\Queue\PsrProcessor;
use Interop\Queue\PsrMessage;
use Interop\Queue\PsrContext;
use Symfony\Component\Message\TopicSubscriberInterface;

class UserUpdatedProcessor implements PsrProcessor, TopicSubscriberInterface
{
    public function process(PsrMessage $message, PsrContext $context) 
    {
        // do some stuff
        
        return self::ACK;    
    }
    
    public static function getSubscribedTopics(): array 
    {
        return ['user_updated'];
    }
}
```

```php
<?php

use Interop\Queue\PsrProcessor;
use Interop\Queue\PsrMessage;
use Interop\Queue\PsrContext;
use Symfony\Component\Message\CommandSubscriberInterface;

class UserUpdatedProcessor implements PsrProcessor, CommandSubscriberInterface
{
    public function process(PsrMessage $message, PsrContext $context) 
    {
        // do some stuff 
        
        return self::ACK;    
    }
    
    public static function getSubscribedCommands(): array 
    {
        return ['send_registration_email'];
    }
}
```
