<?php

namespace MingyuKim\PhpKafka\Libraries;

use MingyuKim\PhpKafka\Traits\SingletonTrait;

class ApiLibrary
{
    use SingletonTrait;

    private ?string $apiUrl;
    private ?string $method;
    private ?array $requestData;

    /**
     * @return string|null
     */
    public function getApiUrl(): ?string
    {
        return $this->apiUrl;
    }

    /**
     * @param string|null $apiUrl
     */
    public function setApiUrl(?string $apiUrl): void
    {
        $this->apiUrl = $apiUrl;
    }

    /**
     * @return string|null
     */
    public function getMethod(): ?string
    {
        return $this->method;
    }

    /**
     * @param string|null $method
     */
    public function setMethod(?string $method): void
    {
        $this->method = $method;
    }

    /**
     * @return array|null
     */
    public function getRequestData(): ?array
    {
        return $this->requestData;
    }

    /**
     * @param array|null $requestData
     */
    public function setRequestData(?array $requestData): void
    {
        $this->requestData = $requestData;
    }

    public function sendRequest(string $returnType = 'string'): string|array
    {
        $returnData = $this->request();

        return match ($returnType) {
            'string' => $returnData,
            'array' => json_decode($returnData,true),
        };
    }

    private function request(): ?string
    {
        $apiUrl = $this->getApiUrl();
        $options = $this->getOptions();

        $context = stream_context_create($options);
        $result = file_get_contents($apiUrl, false, $context);

        if ($result === FALSE) {
            return null;
        }

        return $result;
    }

    private function getOptions(): ?array
    {

        $returnData =  match (strtoupper($this->getMethod())) {
            'GET' =>  [
                'http' => [
                    'method' => 'GET',
                    'header' => 'Content-type: application/json',
                ],
            ],
            'POST' => [
                'http' => [
                    'header' => 'Content-type: application/x-www-form-urlencoded\r\n',
                    'method' => 'POST',
                    'content' => http_build_query($this->getRequestData()),
                ],
            ]
        };

        return $returnData ?? null;
    }

}
