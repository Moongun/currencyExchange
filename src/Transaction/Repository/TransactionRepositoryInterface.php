<?php

declare(strict_types=1);


namespace CurrencyExchange\Transaction\Repository;


use CurrencyExchange\Common\Domain\Repository\RepositoryInterface;
use CurrencyExchange\Transaction\Transaction;

interface TransactionRepositoryInterface extends RepositoryInterface
{
    public function find(string $uuid): Transaction;
}