<?php

declare(strict_types=1);


namespace CurrencyExchange\Transaction\Domain\ValueObject;


use CurrencyExchange\Transaction\Domain\Enum\CurrencyCodeEnum;

abstract class AbstractCurrency
{
    public function __construct(
        protected CurrencyCodeEnum $code,
        protected ?float $amount = null,
    ) { 
    }

    public function getCode(): CurrencyCodeEnum
    {
        return $this->code;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }
}