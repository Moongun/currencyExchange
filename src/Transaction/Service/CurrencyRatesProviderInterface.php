<?php

declare(strict_types=1);


namespace CurrencyExchange\Transaction\Service;


interface CurrencyRatesProviderInterface
{
    public function getRates(): array;
}