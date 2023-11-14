<?php

declare(strict_types=1);


namespace CurrencyExchange\Transaction\Factory;


use CurrencyExchange\Transaction\Domain\Command\CreateTransaction;
use CurrencyExchange\Transaction\Transaction;

interface TransactionFactoryInterface
{
    public function create(CreateTransaction $createTransaction): Transaction;
}