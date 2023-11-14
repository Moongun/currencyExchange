<?php

declare(strict_types=1);


namespace CurrencyExchange\Transaction\Service;


interface ValueFormatterInterface
{
    public function format(float $value): mixed;
}