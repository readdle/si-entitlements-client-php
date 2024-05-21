<?php

require __DIR__ . '/../vendor/autoload.php';

use Readdle\EntitlementsClient\EntitlementsClient;
use Readdle\EntitlementsClient\Exception\EntitlementsClientException;

$client = new EntitlementsClient('https://entitlementer-dev.apps.readdle.com');

try {
    $app = 'PDFExpert';
    $filterType = EntitlementsClient::FILTER_TYPE_ALL;
    $parameters = [
        'countryCode' => 'FR'
    ];

    $response = $client->getEntitlements($app, $filterType, $parameters);

    echo print_r($response, true);
} catch (EntitlementsClientException $e) {
    echo print_r($e->getDebugInfo(), true);
    exit();
}
