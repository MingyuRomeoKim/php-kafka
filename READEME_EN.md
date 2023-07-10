# php-kafka
using kafka with php

## KafkaConsumer

`KafkaConsumer` is a class for consuming messages from Kafka.<Br/>
Below is a basic usage example:

```php
use MingyuKim\PhpKafka\Classes\KafkaConsumer;

// Create a consumer instance
$consumer = KafkaConsumer::getInstance();

// Set configuration
$consumer->setBootstrapServers('localhost:9092');
$consumer->setGroupId('my-group');
// ... set other configuration as needed ...

// Subscribe to topics
$consumer->subscribe(['topic1', 'topic2']);

// Consume messages in a loop
while (true) {
    $message = $consumer->consume(1); // wait for up to 1 second
    // Process the message as needed...
}
```

## KafkaConsumer

KafkaProducer is a class for producing messages to Kafka. <br/>
Below is a basic usage example:
```php
use MingyuKim\PhpKafka\Classes\KafkaProducer;

// Create a producer instance
$producer = KafkaProducer::getInstance();

// Set configuration
$producer->setBootstrapServers('localhost:9092');
// ... set other configuration as needed ...

// Produce a message to a topic
$producer->produce('my-topic', 'my message');

}
```
