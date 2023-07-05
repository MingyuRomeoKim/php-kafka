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
    public function getBootstrapServers(): ?string
    {
        return config('kafka-producer.bootstrap-servers') ?? null;
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

    /**
     * @return string|null
     */
    public function getSaslMechanisms(): ?string
    {
        return config('kafka-producer.sasl-mechanisms') ?? null;
    }

    /**
     * @return string|null
     */
    public function getSslEndpointIdentificationAlgorithm(): ?string
    {
        return config('kafka-producer.ssl-endpoint-identification-algorithm') ?? null;
    }

    /**
     * @return string|null
     */
    public function getSaslUsername(): ?string
    {
        return config('kafka-producer.sasl-username') ?? null;
    }

    /**
     * @return string|null
     */
    public function getSaslPassword(): ?string
    {
        return config('kafka-producer.sasl-password') ?? null;
    }

    /**
     * @return string|null
     */
    public function getSecurityProtocol(): ?string
    {
        return config('kafka-producer.security-protocol') ?? null;
    }

    /**
     * @return string|null
     */
    public function getSslCaLocation(): ?string
    {
        return config('kafka-producer.ssl-ca-location') ?? null;
    }

    /**
     * @return string|null
     */
    public function getSslCertificateLocation(): ?string
    {
        return config('kafka-producer.ssl-certificate-location') ?? null;
    }

    /**
     * @return string|null
     */
    public function getSslKeyLocation(): ?string
    {
        return config('kafka-producer.ssl-key-location') ?? null;
    }
}