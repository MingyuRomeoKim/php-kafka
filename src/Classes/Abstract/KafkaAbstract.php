<?php

namespace MingyuKim\PhpKafka\Classes\Abstract;

abstract class KafkaAbstract
{

    public \RdKafka\Producer|\RdKafka\KafkaConsumer|null $connect = null;

    /**
     * @var \RdKafka\Topic 현재 토픽
     */
    protected $topic = null;

    /**
     * @var array 현재까지 생성된 토픽배열
     */
    protected $topics = null;

    protected function connection(): \RdKafka\KafkaConsumer|\RdKafka\Producer|null
    {
        if ($this->connect !== null) {
            return $this->connect;
        }

        $config = $this->getConfig();
        $this->connect = $this->connect($config);

        return $this->connect ?? null;
    }

    /*
     * 하위 클래스에서 재정의
     */
    abstract protected function connect(\RdKafka\TopicConf $config): \RdKafka\KafkaConsumer|\RdKafka\Producer|null;
    abstract protected function getConfig(): \RdKafka\Conf|null;
    abstract public function newTopic(string $topicName, \RdKafka\Conf $conf);

    protected function topicExists(string $topicName): bool
    {
        $metadata = $this->connect->getMetadata(true, null, 60*1000);
        $topics = $metadata->getTopics();
        foreach ($topics as $topic) {
            if ($topic->getName() === $topicName) {
                return true;
            }
        }
        return false;
    }

}