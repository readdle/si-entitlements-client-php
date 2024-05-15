<?php

require __DIR__ . '/../vendor/autoload.php';

use Readdle\EntitlementsClient\EntitlementsClient;
use Readdle\EntitlementsClient\Exception\EntitlementsClientException;

$client = new EntitlementsClient('https://entitlementer-dev.apps.readdle.com');

try {
    $app = 'PDFExpert';
    $products = ['com.readdle.PDFExpert5.subscription.year50'];
    $bundles = ['com.readdle.PDFExpert-Mac'];
    $parameters = [
        'accountCreatedTs' => '1708337278',
        'application_version' => 3,
        'original_purchase_date_ms' => 1714680000
    ];

    $response = $client->getPermits($app, $products, $parameters, $bundles);

    echo print_r($response, true);
} catch (EntitlementsClientException $e) {
    echo print_r($e->getDebugInfo(), true);
    exit();
}
