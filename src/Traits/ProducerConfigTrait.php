<?php

namespace MingyuKim\PhpKafka\Traits;

trait ProducerConfigTrait
{
    /**
     * @return string|null
     */
    public function getClientId(): ?string
    {
        return config('kafka-producer.client-id') ?? null;
    }

    /**
     * @return string|null
     */
    public function getMetadataBrokerList(): ?string
    {
        return config('kafka-producer.metadata-broker-list') ?? null;
    }

    /**
     * @return string|null
     */
    public function getCompressionCodec(): ?string
    {
        return config('kafka-producer.compression-codec') ?? null;
    }

    /**
     * @return string|null
     */
    public function getMessageTimeoutMs(): ?string
    {
        return config('kafka-producer.message-timeout-ms') ?? null;
    }

    /**
     * @return string|null
     */
    public function getEnableIdempotence(): ?string
    {
        return config('kafka-producer.enable-idempotence') ?? null;
    }
}