<?php

declare(strict_types=1);


namespace CurrencyExchange\Transaction\Domain\Exception;


use CurrencyExchange\Transaction\Domain\Enum\CurrencyCodeEnum;
use Exception;

class CurrencyRateNotFoundException extends Exception
{
    public function __construct(CurrencyCodeEnum $source, CurrencyCodeEnum $target)
    {
        parent::__construct(sprintf("Rate not found for exchange %s into %s", $source->value, $target->value), 0, null);
    }
}