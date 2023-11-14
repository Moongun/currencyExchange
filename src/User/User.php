<?php

declare(strict_types=1);


namespace CurrencyExchange\User;


use CurrencyExchange\Common\Domain\EntityInterface;
use Ramsey\Uuid\UuidInterface;

class User implements EntityInterface
{
    public function __construct(
        private UuidInterface $uuid,
    ) {
    }

    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }
}