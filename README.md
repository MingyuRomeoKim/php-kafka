# php-kafka
php를 사용해서 카프카 컨슈밍 프로듀싱 쉽게 하기


## 사전 준비
해당 패키지를 사용하기 위해서는 사용하고자 하는 곳에 RdKafka 라이브러리가 설치되어 있어야 한다.<br/>
설치되어있지 않다면 아래 명령어들을 통해 rdkafka를 설치해보자.<br/>
```shell
sudo apt-get update && sudo apt-get upgrade -y
sudo apt-get install librdkafka-dev
sudo apt-get install php-dev
sudo apt-get install php-pear
sudo pecl install rdkafka
# 설치된 php 버전의 ini파일에 extension 추가하기
echo "extension=rdkafka.so" | sudo tee -a /etc/php/8.1/cli/php.ini 
```

## 설치 방법
다음의 명령어를 사용해 composer를 통해 패키지를 설치합니다:

```
composer require mingyukim/php-kafka
```

또는 composer.json의 require-dev 섹션에 다음을 추가하고 `composer update`를 실행합니다:


```json
"require": {
      "mingyukim/php-kafka": "*"
}
```

## 패키지 설정 파일 발행

```shell
 php artisan vendor:publish --provider="MingyuKim\PhpKafka\PhpKafkaProvider" --tag="config"
```

### 기본 설정 변경하기 <br/>

[config/kafka-consumer.php]
```php
<?php
return [
    /*
     * Kafka 브로커에 보이는 클라이언트의 ID를 설정합니다. 클라이언트 ID는 주로 로그와 메트릭을 생성할 때 사용됩니다.
     */
    'client-id' => '',
    /*
     * bootstrap.servers는 Kafka 브로커에 연결하는 데 필요한 호스트 이름과 포트 번호를 설정합니다.
     */
    'bootstrap-servers' => 'your-kafka:your-port',
    /*
     * group.id는 Kafka 컨슈머 그룹의 ID를 설정합니다. 같은 그룹 ID를 가진 컨슈머들은 같은 메시지를 동시에 처리하지 않습니다.
     */
    'group-id' => 'your-kafka-group-id',
    /*
     * enable.partition.eof는 파티션의 끝(end of file, EOF)에 도달했을 때 표시를 내보내는지 여부를 설정합니다. 이 옵션이 true로 설정되면, 파티션의 끝에 도달하면 컨슈머에게 알려줍니다.
     */
    'enable-partition-eof' => 'true',
    /*
     * auto.offset.reset는 Kafka 컨슈머가 이전에 커밋된 오프셋이 없거나, 현재 오프셋이 더 이상 유효하지 않은 경우 어떻게 처리할지를 설정합니다. 'earliest'로 설정하면 가장 처음의 오프셋에서 시작합니다.
     */
    'auto-offset-reset' => 'earliest',
    /*
     * log_level는 로깅 레벨을 설정합니다. 여기서는 LOG_DEBUG로 설정되어 있으므로, 디버그 레벨의 로그를 출력합니다.
     */
    'log-level' => (string) LOG_DEBUG,
    /*
     * debug는 어떤 종류의 정보를 디버그할지를 설정합니다. 'all'로 설정하면 모든 종류의 정보를 디버그합니다.
     */
    'debug' => 'all',




    /*
     * SASL(간단한 인증 및 보안 계층) 메커니즘을 설정합니다. 일반적으로 "PLAIN", "SCRAM-SHA-256", "SCRAM-SHA-512" 등이 사용됩니다. 빈 문자열은 사용하지 않겠다는 의미입니다.
     */
    'sasl-mechanisms' => '',
    /*
     * 브로커의 호스트 이름 검증에 사용할 알고리즘을 설정합니다. https는 브로커의 호스트 이름을 검증하려면 HTTPS처럼 사용됩니다.
     */
    'ssl-endpoint-identification-algorithm' => '', // https
    /*
     * SASL 인증에 사용할 사용자 이름 및 패스워드를 설정합니다.
     */
    'sasl-username' => '',
    'sasl-password' => '',


    /*
     * 사용할 보안 프로토콜을 설정합니다. 'ssl'은 SSL/TLS를 사용하여 통신을 암호화합니다.
     */
    'security-protocol' => '', // 'ssl'
    /*
     * CA(Certificate Authority) 인증서의 위치를 설정합니다. CA 인증서는 브로커의 서버 인증서를 검증하는 데 사용됩니다.
     */
    'ssl-ca-location' => '', //  __DIR__.'/../../../keys/ca.pem'
    /*
     * 클라이언트의 공개키 인증서의 위치를 설정합니다.
     */
    'ssl-certificate-location' => '', // __DIR__.'/../../../keys/kafka.cert'
    /*
     * 클라이언트의 개인키 인증서의 위치를 설정합니다.
     */
    'ssl-key-location' => '', // __DIR__.'/../../../keys/kafka.key'
];
```
<br/>

[config/kafka-producer.php]
```php
<?php
return [
    /*
     * Kafka 브로커에 보이는 클라이언트의 ID를 설정합니다. 클라이언트 ID는 주로 로그와 메트릭을 생성할 때 사용됩니다.
     */
    'client-id' => '',
    /*
     * bootstrap.servers는 Kafka 브로커에 연결하는 데 필요한 호스트 이름과 포트 번호를 설정합니다.
     */
    'bootstrap-servers' => 'localhost:9092',
    /*
     * Kafka 브로커에 연결하는 데 필요한 호스트 이름과 포트 번호를 설정합니다.
     */
    'metadata-broker-list' => 'localhost:9092',
    /*
     * Kafka 프로듀서가 메시지를 압축하는 데 사용할 코덱을 설정합니다. 'none', 'gzip', 'lz4', 'snappy', 'zstd' 등을 설정할 수 있습니다.
     */
    'compression-codec' => 'snappy',
    /*
     * 메시지 전송에 대한 타임아웃을 설정합니다. 설정된 시간(밀리초 단위) 동안 메시지 전송이 완료되지 않으면 프로듀서는 재시도합니다.
     */
    'message-timeout-ms' => '5000', // 5초
    /*
     * 프로듀서의 아이덤포턴스를 설정합니다. 이 옵션은 "정확히 한 번의" 메시지 전송을 보장합니다. 이는 중복 메시지를 방지하고, 메시지의 순서를 유지합니다.
     */
    'enable-idempotence' => 'true',


    /*
     * SASL(간단한 인증 및 보안 계층) 메커니즘을 설정합니다. 일반적으로 "PLAIN", "SCRAM-SHA-256", "SCRAM-SHA-512" 등이 사용됩니다. 빈 문자열은 사용하지 않겠다는 의미입니다.
     */
    'sasl-mechanisms' => '',
    /*
     * 브로커의 호스트 이름 검증에 사용할 알고리즘을 설정합니다. https는 브로커의 호스트 이름을 검증하려면 HTTPS처럼 사용됩니다.
     */
    'ssl-endpoint-identification-algorithm' => '', // https
    /*
     * SASL 인증에 사용할 사용자 이름 및 패스워드를 설정합니다.
     */
    'sasl-username' => '',
    'sasl-password' => '',


    /*
     * 사용할 보안 프로토콜을 설정합니다. 'ssl'은 SSL/TLS를 사용하여 통신을 암호화합니다.
     */
    'security-protocol' => '', // 'ssl'
    /*
     * CA(Certificate Authority) 인증서의 위치를 설정합니다. CA 인증서는 브로커의 서버 인증서를 검증하는 데 사용됩니다.
     */
    'ssl-ca-location' => '', //  __DIR__.'/../../../keys/ca.pem'
    /*
     * 클라이언트의 공개키 인증서의 위치를 설정합니다.
     */
    'ssl-certificate-location' => '', // __DIR__.'/../../../keys/kafka.cert'
    /*
     * 클라이언트의 개인키 인증서의 위치를 설정합니다.
     */
    'ssl-key-location' => '', // __DIR__.'/../../../keys/kafka.key'
];
```

## KafkaConsumer

`KafkaConsumer`는 카프카에서 메세지를 컨슈밍 합니다. <br/>
기본 사용법:

```php
use MingyuKim\PhpKafka\Classes\KafkaConsumer;

// consumer 및 필요 객체 초기화
$kafkaConsumer = KafkaConsumer::getInstance();
$dataLibrary = DataLibrary::getInstance();
// 토픽 구독
$kafkaConsumer->subscribe('test-topic');

// messages 읽어오기
while (true) {
    $message = $kafkaConsumer->consume(1); // wait for up to 1 second
    // Process the message as needed...
    $payload = $message->payload;
    $payloadArray = $dataLibrary->convert(gettype($payload),'array',$payload);
    dump($payloadArray);
}

```

## KafkaProducer

`KafkaProducerClass`는 카프카에서 메세지를 프로듀싱 합니다. <br/>
기본 사용법:

```php
use MingyuKim\PhpKafka\Classes\KafkaProducer;

// producer 및 필요 객체 초기화
$producer = KafkaProducer::getInstance();
$apiLibrary = ApiLibrary::getInstance();
$dataLibrary = DataLibrary::getInstance();

// 테스트 Json 데이터 생성
$apiLibrary->setApiUrl('https://jsonplaceholder.typicode.com/posts');
$apiLibrary->setMethod('GET');
$resultArray = $apiLibrary->sendRequest('array');

foreach ($resultArray as $result) {
    $jsonResult = $dataLibrary->convert(gettype($result), 'string', $result);

    //프로듀싱 하기
    $producer->produce('test-topic',$jsonResult);
}
```
