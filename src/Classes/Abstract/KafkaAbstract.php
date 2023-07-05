<?php

namespace MingyuKim\PhpKafka\Classes\Abstract;

abstract class KafkaAbstract
{

    public \RdKafka\Producer|\RdKafka\KafkaConsumer|null $connect = null;


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


}