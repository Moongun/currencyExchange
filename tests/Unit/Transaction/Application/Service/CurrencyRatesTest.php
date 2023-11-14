<?php

declare(strict_types=1);

namespace Tests\Unit\Transaction\Application\Service;

use CurrencyExchange\Transaction\Application\Service\CurrencyRateSelector;
use CurrencyExchange\Transaction\Domain\Enum\CurrencyCodeEnum;
use CurrencyExchange\Transaction\Domain\Exception\CurrencyRateNotFoundException;
use CurrencyExchange\Transaction\Domain\ValueObject\Rate;
use CurrencyExchange\Transaction\Service\CurrencyRatesProviderInterface;
use PHPUnit\Framework\TestCase;
use Test\Mock\Transaction\Application\Service\CurrencyRatesProvider;

class CurrencyRatesTest extends TestCase
{
    public function testIfRateNotExists(): void
    {
        $currencyRatesProviderStub = $this->createStub(CurrencyRatesProviderInterface::class);
        $currencyRatesProviderStub->method('getRates')->willReturn([]);

        $currencyRates = new CurrencyRateSelector($currencyRatesProviderStub);

        $this->expectException(CurrencyRateNotFoundException::class);
        $currencyRates->select(CurrencyCodeEnum::EUR, CurrencyCodeEnum::GBP);
    }

    public function testsIfRateExists(): void
    {
        $currencyRates = new CurrencyRateSelector(new CurrencyRatesProvider());
        $rate = $currencyRates->select(CurrencyCodeEnum::EUR, CurrencyCodeEnum::GBP);
        $this->assertEquals(new Rate(1.5678), $rate);
    }
}
