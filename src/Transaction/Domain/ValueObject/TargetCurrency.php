<?php

declare(strict_types=1);


namespace CurrencyExchange\Transaction\Domain\ValueObject;


final class TargetCurrency extends AbstractCurrency
{
    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }
}