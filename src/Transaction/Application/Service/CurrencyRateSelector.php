<?php

declare(strict_types=1);


namespace CurrencyExchange\Transaction\Application\Service;


use CurrencyExchange\Transaction\Domain\Enum\CurrencyCodeEnum;
use CurrencyExchange\Transaction\Domain\Exception\CurrencyRateNotFoundException;
use CurrencyExchange\Transaction\Domain\ValueObject\Rate;
use CurrencyExchange\Transaction\Service\CurrencyRateSelectorInterface;
use CurrencyExchange\Transaction\Service\CurrencyRatesProviderInterface;

class CurrencyRateSelector implements CurrencyRateSelectorInterface
{
    public function __construct(
        private CurrencyRatesProviderInterface $currencyRatesProvider,
    ) { 
    }

    public function select(CurrencyCodeEnum $source, CurrencyCodeEnum $target): Rate
    {
        $rates = $this->currencyRatesProvider->getRates();

        if (!isset($rates[$source->value][$target->value])) {
            throw new CurrencyRateNotFoundException($source, $target);
        }

        return new Rate($rates[$source->value][$target->value]);
    }
}