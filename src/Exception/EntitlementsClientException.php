<?php
declare(strict_types=1);

namespace Readdle\EntitlementsClient\Exception;

use Exception;

class EntitlementsClientException extends Exception
{
    protected string $requestURL = '';
    protected string $requestMethod = '';
    protected ?int $responseCode = null;
    protected string $responseBody = '';

    public function __construct(
        string $message = '',
        string $requestURL = '',
        string $requestMethod = '',
        int $responseCode = 0,
        string $responseBody = ''
    ) {
        parent::__construct($message);

        $this->requestURL = $requestURL;
        $this->requestMethod = $requestMethod;
        $this->responseCode = $responseCode;
        $this->responseBody = $responseBody;
    }

    public function getRequestURL(): string
    {
        return $this->requestURL;
    }

    public function getRequestMethod(): string
    {
        return $this->requestMethod;
    }

    public function getResponseCode(): ?int
    {
        return $this->responseCode;
    }

    public function getResponseBody(): string
    {
        return $this->responseBody;
    }

    public function getDebugInfo(): array
    {
        return [
            'message' => $this->getMessage(),
            'request' => [
                'uri' => $this->getRequestURL(),
                'method' => $this->getRequestMethod()
            ],
            'response' => [
                'code' => $this->getResponseCode(),
                'body' => $this->getResponseBody()
            ]
        ];
    }
}
