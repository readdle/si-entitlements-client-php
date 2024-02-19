<?php
declare(strict_types=1);

namespace Readdle\EntitlementsClient;

interface EntitlementsClientInterface
{
    public function getPermits(string $app, array $products, array $additionalParameters = []): array;
}
