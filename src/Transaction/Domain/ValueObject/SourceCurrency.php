<?php

declare(strict_types=1);


namespace CurrencyExchange\Transaction\Domain\ValueObject;


use CurrencyExchange\Transaction\Domain\Enum\CurrencyCodeEnum;

final class SourceCurrency extends AbstractCurrency
{
    public function __construct(CurrencyCodeEnum $code, float $amount)
    {
        parent::__construct($code, $amount);
    }
}