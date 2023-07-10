# php-kafka
php를 사용해서 카프카 컨슈밍 프로듀싱 쉽게 하기


## KafkaConsumer

`KafkaConsumer`는 카프카에서 메세지를 컨슈밍 합니다. <br/>
기본 사용법:

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

## KafkaProducer

`KafkaProducerClass`는 카프카에서 메세지를 프로듀싱 합니다. <br/>
기본 사용법:

```php
use MingyuKim\PhpKafka\Classes\KafkaProducer;

// Create a producer instance
$producer = KafkaProducer::getInstance();

// Set configuration
$producer->setBootstrapServers('localhost:9092');
// ... set other configuration as needed ...

// Produce a message to a topic
$producer->produce('my-topic', 'my message');
```
