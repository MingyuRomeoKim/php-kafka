<?php

namespace MingyuKim\PhpKafka\Classes;

use MingyuKim\PhpKafka\Classes\Abstract\KafkaAbstract;
use MingyuKim\PhpKafka\Traits\ProducerConfigTrait;
use MingyuKim\PhpKafka\Traits\SingletonTrait;

class KafkaProducer extends KafkaAbstract
{
    use SingletonTrait, ProducerConfigTrait;

    /**
     * @var integer 이벤트 대기 시간(ms)
     */
    const WAITING_FOR_EVENTS = 1000;

    /**
     * @param \RdKafka\TopicConf $config
     * @return \RdKafka\Producer|null
     */
    protected function connect(\RdKafka\TopicConf $config): \RdKafka\Producer|null
    {
        return new \RdKafka\Producer($config);
    }

    protected function getConfig(): \RdKafka\Conf|null
    {
        $conf = new \RdKafka\Conf();
        $conf->set('bootstrap.servers', $this->getBootstrapServers());
        $conf->set('client.id', $this->getClientId());
        $conf->set('metadata.broker.list', $this->getMetadataBrokerList());
        $conf->set('compression.codec', $this->getCompressionCodec());
        $conf->set('message.timeout.ms', $this->getMessageTimeoutMs());
        $conf->set('enable.idempotence', $this->getEnableIdempotence());

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

    public function produce(string $topic, string $message): void
    {
        try {
            if (!$topic || !$this->topicExists($topic)) {
                throw new \Exception("Invalid topic: {$topic}");
            }

            $topic = $this->connect->newTopic($topic);
            $topic->produce(RD_KAFKA_PARTITION_UA, 0, $message);
            $this->connect->poll(self::WAITING_FOR_EVENTS);

            while ($this->connect->getOutQLen() > 0) {
                $this->connect->poll(self::WAITING_FOR_EVENTS);
            }
        } catch (\Exception $exception){
            dump('Kafka Produce produce error :: ');
            dump($exception->getMessage());
        }
    }


    public function newTopic(string $topicName, \RdKafka\Conf $conf)
    {
        return $this->connect->newTopic($topicName, $conf);
    }
}