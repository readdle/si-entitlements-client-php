<?php

require __DIR__ . '/../vendor/autoload.php';

use Readdle\EntitlementsClient\EntitlementsClient;
use Readdle\EntitlementsClient\Exception\EntitlementsClientException;

$client = new EntitlementsClient('https://entitlementer-dev.apps.readdle.com');

try {
    $response = $client->getPermits(
        'PDFExpert',
        ['com.readdle.PDFExpert5.subscription.year50'],
        ['accountCreatedTs' => '1708337278']
    );
    echo print_r($response, true);
} catch (EntitlementsClientException $e) {
    echo print_r($e->getDebugInfo(), true);
    exit();
}
