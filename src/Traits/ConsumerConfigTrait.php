<?php

namespace MingyuKim\PhpKafka\Traits;

trait ConsumerConfigTrait
{
    /**
     * @return string|null
     */
    public function getClientId(): ?string
    {
        return config('kafka-consumer.client-id') ?? null;
    }

    /**
     * @return string|null
     */
    public function getBootstrapServers(): ?string
    {
        return config('kafka-consumer.bootstrap-servers') ?? null;
    }

    /**
     * @return string|null
     */
    public function getGroupId(): ?string
    {
        return config('kafka-consumer.group-id') ?? null;
    }

    /**
     * @return string|null
     */
    public function getEnablePartitionEof(): ?string
    {
        return config('kafka-consumer.enable-partition-eof') ?? null;
    }

    /**
     * @return string|null
     */
    public function getAutoOffsetReset(): ?string
    {
        return config('kafka-consumer.auto-offset-reset') ?? null;
    }

    /**
     * @return string|null
     */
    public function getLogLevel(): ?string
    {
        return config('kafka-consumer.log-level') ?? null;
    }

    /**
     * @return string|null
     */
    public function getDebug(): ?string
    {
        return config('kafka-consumer.debug') ?? null;
    }

    /**
     * @return string|null
     */
    public function getSaslMechanisms(): ?string
    {
        return config('kafka-consumer.sasl-mechanisms') ?? null;
    }

    /**
     * @return string|null
     */
    public function getSslEndpointIdentificationAlgorithm(): ?string
    {
        return config('kafka-consumer.ssl-endpoint-identification-algorithm') ?? null;
    }

    /**
     * @return string|null
     */
    public function getSaslUsername(): ?string
    {
        return config('kafka-consumer.sasl-username') ?? null;
    }

    /**
     * @return string|null
     */
    public function getSaslPassword(): ?string
    {
        return config('kafka-consumer.sasl-password') ?? null;
    }

    /**
     * @return string|null
     */
    public function getSecurityProtocol(): ?string
    {
        return config('kafka-consumer.security-protocol') ?? null;
    }

    /**
     * @return string|null
     */
    public function getSslCaLocation(): ?string
    {
        return config('kafka-consumer.ssl-ca-location') ?? null;
    }

    /**
     * @return string|null
     */
    public function getSslCertificateLocation(): ?string
    {
        return config('kafka-consumer.ssl-certificate-location') ?? null;
    }

    /**
     * @return string|null
     */
    public function getSslKeyLocation(): ?string
    {
        return config('kafka-consumer.ssl-key-location') ?? null;
    }

}