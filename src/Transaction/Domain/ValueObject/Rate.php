<?php

declare(strict_types=1);


namespace CurrencyExchange\Transaction\Domain\ValueObject;


class Rate
{
    public function __construct(private float $rate)
    {
    }

    public function getRate(): float
    {
        return $this->rate;
    }
}