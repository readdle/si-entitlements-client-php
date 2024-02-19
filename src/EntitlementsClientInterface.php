<?php
declare(strict_types=1);

namespace Readdle\EntitlementsClient;

interface EntitlementsClientInterface
{
    public function request(string $method, string $uri, array $query = []): array;
}
