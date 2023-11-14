<?php

declare(strict_types=1);


namespace Test\Mock\Transaction\Application\Service;


use CurrencyExchange\Transaction\Service\CurrencyRatesProviderInterface;

class CurrencyRatesProvider implements CurrencyRatesProviderInterface
{
    public function getRates(): array
    {
        return [
            'EUR' => ['GBP' => 1.5678],
            'GBP' => ['EUR' => 1.5432],
        ];
        
    }
}