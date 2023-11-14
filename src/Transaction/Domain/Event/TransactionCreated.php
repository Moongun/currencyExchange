<?php

declare(strict_types=1);


namespace CurrencyExchange\Transaction\Domain\Event;


use CurrencyExchange\Common\Domain\Event\EventInterface;
use CurrencyExchange\Transaction\Transaction;

class TransactionCreated implements EventInterface
{
    public function __construct(private Transaction $transaction)
    {
    }

    public function details(): array
    {
        return ['details' => serialize($this->transaction)];
    }
}