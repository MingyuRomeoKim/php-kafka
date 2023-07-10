<?php

namespace MingyuKim\PhpKafka\Classes;

use MingyuKim\PhpKafka\Classes\Abstract\KafkaAbstract;
use MingyuKim\PhpKafka\Traits\ConsumerConfigTrait;
use MingyuKim\PhpKafka\Traits\SingletonTrait;

class KafkaConsumer extends KafkaAbstract
{
    use SingletonTrait, ConsumerConfigTrait;

    /**
     * Consumer 연결하기
     * @param \RdKafka\Conf $config
     * @return \RdKafka\KafkaConsumer | null
     */
    protected function connect($config): \RdKafka\KafkaConsumer|null
    {
        return new \RdKafka\KafkaConsumer($config);
    }

    /**
     * Config 설정하기
     * @return \RdKafka\Conf|null
     */
    protected function getConfig(): \RdKafka\Conf|null
    {
        $conf = new \RdKafka\Conf();
        $conf->set('bootstrap.servers', $this->getBootstrapServers());
        $conf->set('group.id', $this->getGroupId());
        $conf->set('enable.partition.eof', $this->getEnablePartitionEof());
        $conf->set('auto.offset.reset', $this->getAutoOffsetReset());
        $conf->set('log_level', $this->getLogLevel());
        $conf->set('debug', $this->getDebug());

        if (!is_null($this->getSaslMechanisms())) {
            // SASL Authentication
            $conf->set('sasl.mechanisms', $this->getSaslMechanisms());
            $conf->set('sasl.username', $this->getSaslUsername());
            $conf->set('sasl.password', $this->getSaslPassword());
            $conf->set('ssl.endpoint.identification.algorithm', $this->getSslEndpointIdentificationAlgorithm());
        }

        if (!is_null($this->getSecurityProtocol())) {
            // SSL Authentication
            $conf->set('security.protocol', $this->getSecurityProtocol());
            $conf->set('ssl.ca.location', $this->getSslCaLocation());
            $conf->set('ssl.certificate.location', $this->getSslCertificateLocation());
            $conf->set('ssl.key.location', $this->getSslKeyLocation());
        }

        return $conf;
    }

    /**
     * 토픽 구독 하기
     */
    public function subscribe(array|string $topicName): void
    {

        $this->connection();

        if (is_array($topicName) == false) {
            $topicName = str_replace(' ', '', $topicName);
            $topicName = explode(",", $topicName);
        }

        $this->connect->subscribe($topicName);
    }

    /**
     * 토픽 구독 종료 하기
     */
    public function unsubscribe(): void
    {
        try {
            $this->connect->unsubscribe();
        } catch(\Exception $e) {
            dump("KafkaConsumer unsubscribe Error :: ");
            dump($e->getMessage());
        }
    }

    /**
     * 커밋
     *
     * @return void
     */
    public function commit(): void
    {
        try {
            $this->connect->commit();
        } catch(\Exception $e) {
            dump("KafkaConsumer commit Error :: ");
            dump($e->getMessage());
        }
    }

    /**
     * 비동기 커밋
     */
    public function commitAsync(): void
    {
        try {
            $this->connect->commitAsync();
        } catch(\Exception $e) {
            dump("KafkaConsumer commitAsync Error :: ");
            dump($e->getMessage());
        }
    }

    /**
     * topic 읽어오기
     *
     * @param int $waitForSeconds topic 데이터가 없을때 다음 검색까지 대기시간(초) 1: 1초 , 0.1: 0.1초
     * @param string $error_code 에러 코드
     *
     * @return \RdKafka\Message
     */
    public function consume($waitForSeconds, &$error_code = '000'): \RdKafka\Message
    {
        $message = $this->connect->consume($waitForSeconds * 1000);

        switch ($message->err) {
            case RD_KAFKA_RESP_ERR_NO_ERROR:
                $error_code = '000';
                $this->processMessage($message);
                break;
            case RD_KAFKA_RESP_ERR__PARTITION_EOF:
                $error_code = '404';
                break;
            case RD_KAFKA_RESP_ERR__TIMED_OUT:
                $error_code = '408';
                break;
            default:
                $error_code = '500';
                break;
        }

        return $message;
    }


    /**
     * Process the consumed message
     *
     * @param \RdKafka\Message $message
     *
     * @return void
     */
    protected function processMessage(\RdKafka\Message $message): void
    {
        // Add your business logic here. For example:
        echo "Received message with key: {$message->key} and payload: {$message->payload}\n";
    }
}