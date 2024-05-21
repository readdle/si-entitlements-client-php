<?php
declare(strict_types=1);

namespace Readdle\EntitlementsClient;

use Readdle\EntitlementsClient\Exception\EntitlementsClientException;

class EntitlementsClient implements EntitlementsClientInterface
{
    public const FILTER_TYPE_ALL = 'all';
    public const FILTER_TYPE_PERMITTED = 'permitted';
    public const FILTER_TYPE_BLOCKED = 'blocked';

    private string $baseUri;

    public function __construct(string $baseURL)
    {
        $this->baseUri = rtrim($baseURL, '/');
    }

    /**
     * @throws EntitlementsClientException
     */
    private function request(string $uri, array $query = []): array
    {
        $url = $this->buildUrl($uri, $query);

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
        ]);

        $response = curl_exec($ch);
        $statusCode = (int) curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
        curl_close($ch);

        $requestInfo = [
            'requestURL' => $url,
            'requestMethod' => 'GET',
            'responseCode' => $statusCode,
            'responseBody' => (string) $response
        ];

        if ($response === false) {
            throw new EntitlementsClientException('EntitlementsClient: failed to get response', ...$requestInfo);
        }

        if ($statusCode < 200 || $statusCode >= 300) {
            throw new EntitlementsClientException('EntitlementsClient: wrong response code', ...$requestInfo);
        }

        return (array) json_decode($response, true);
    }

    private function buildUrl(string $uri, array $query): string
    {
        $url = $this->baseUri . '/api/' . ltrim($uri, '/');
        if (!empty($query)) {
            $url .= '?' . http_build_query($query);
        }

        return $url;
    }

    /**
     * @throws EntitlementsClientException
     */
    public function getPermits(
        ?string $app = null,
        array $products = [],
        array $additionalParameters = [],
        array $bundles = []
    ): array {
        return $this->request('permits', array_filter(compact('app', 'products', 'bundles', 'additionalParameters')));
    }

    /**
     * @throws EntitlementsClientException
     */
    public function getEntitlements(
        ?string $app = null,
        string $filterType = self::FILTER_TYPE_ALL,
        array $additionalParameters = []
    ): array {
        return $this->request('entitlements', array_filter(compact('app', 'filterType', 'additionalParameters')));
    }
}
