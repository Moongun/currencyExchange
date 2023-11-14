<?php

declare(strict_types=1);


namespace CurrencyExchange\Transaction\Service;


use CurrencyExchange\Transaction\Domain\Enum\CurrencyCodeEnum;
use CurrencyExchange\Transaction\Domain\ValueObject\Rate;

interface CurrencyRateSelectorInterface
{
    public function select(CurrencyCodeEnum $source, CurrencyCodeEnum $target): Rate;
}