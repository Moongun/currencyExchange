<?php

declare(strict_types=1);


namespace CurrencyExchange\User\Repository;


use CurrencyExchange\Common\Domain\Repository\RepositoryInterface;
use CurrencyExchange\User\User;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function find(string $uuid): User;
}