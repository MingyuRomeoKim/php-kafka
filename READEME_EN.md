# php-kafka
using kafka with php

## KafkaConsumer

`KafkaConsumer` is a class for consuming messages from Kafka.<Br/>
Below is a basic usage example:

```php
use MingyuKim\PhpKafka\Classes\KafkaConsumer;

// create consumer and need object init
$kafkaConsumer = KafkaConsumer::getInstance();
$dataLibrary = DataLibrary::getInstance();

// subscribe topic
$kafkaConsumer->subscribe('test-topic');

// read message
while (true) {
    $message = $kafkaConsumer->consume(1); // wait for up to 1 second
    // Process the message as needed...
    $payload = $message->payload;
    $payloadArray = $dataLibrary->convert(gettype($payload),'array',$payload);
    dump($payloadArray);
}
```

## KafkaProducer

KafkaProducer is a class for producing messages to Kafka. <br/>
Below is a basic usage example:
```php
use MingyuKim\PhpKafka\Classes\KafkaProducer;

// producer and need object init
$producer = KafkaProducer::getInstance();
$apiLibrary = ApiLibrary::getInstance();
$dataLibrary = DataLibrary::getInstance();

// make Test Json Data
$apiLibrary->setApiUrl('https://jsonplaceholder.typicode.com/posts');
$apiLibrary->setMethod('GET');
$resultArray = $apiLibrary->sendRequest('array');

foreach ($resultArray as $result) {
    $jsonResult = $dataLibrary->convert(gettype($result), 'string', $result);

    //just produce
    $producer->produce('test-topic',$jsonResult);
}
```
