<?php

declare(strict_types=1);


namespace CurrencyExchange\Transaction\Application\Service;


use CurrencyExchange\Transaction\Service\ValueFormatterInterface;

class AmountFormatter implements ValueFormatterInterface
{
    public function format(float $value) : float
    {
        return round($value, 3);
    }
}