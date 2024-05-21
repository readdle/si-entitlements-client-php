<?php
declare(strict_types=1);

namespace Readdle\EntitlementsClient;

interface EntitlementsClientInterface
{
    public const FILTER_TYPE_ALL = 'all';
    public const FILTER_TYPE_PERMITTED = 'permitted';
    public const FILTER_TYPE_BLOCKED = 'blocked';

    public function getPermits(string $app, array $products, array $additionalParameters = []): array;

    public function getEntitlements(
        ?string $app = null,
        string $filterType = self::FILTER_TYPE_ALL,
        array $additionalParameters = []
    ): array;
}
