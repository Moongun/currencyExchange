<?php

declare(strict_types=1);


namespace CurrencyExchange\Common\Domain\Repository;


use CurrencyExchange\Common\Domain\EntityInterface;

interface RepositoryInterface
{
    public function find(string $uuid): mixed;

    public function save(EntityInterface $entity): void;
}