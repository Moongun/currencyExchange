<?php

declare(strict_types=1);

namespace Test\Unit\Transaction\Application\Service;

use CurrencyExchange\Transaction\Application\Factory\TransactionTypePolicyFactory;
use CurrencyExchange\Transaction\Application\Service\AmountCalculator;
use CurrencyExchange\Transaction\Application\Service\AmountFormatter;
use CurrencyExchange\Transaction\Application\Service\CurrencyRateSelector;
use CurrencyExchange\Transaction\Domain\Enum\CurrencyCodeEnum;
use CurrencyExchange\Transaction\Domain\Enum\TransactionTypeEnum;
use CurrencyExchange\Transaction\Domain\ValueObject\SourceCurrency;
use CurrencyExchange\Transaction\Domain\ValueObject\TargetCurrency;
use PHPUnit\Framework\TestCase;
use Test\Mock\Transaction\Application\Service\CurrencyRatesProvider;

class AmountCalculatorTest extends TestCase
{
    /**
     * @dataProvider provideData
     */
    public function testCalculateAmount($expected, $transactionTypeEnum, $sourceCurrency, $targetCurrency): void
    {
        $calculator = new AmountCalculator(
            new CurrencyRateSelector(new CurrencyRatesProvider()),
            new TransactionTypePolicyFactory(),
            new AmountFormatter(),
        );

        $this->assertEquals($expected, $calculator->calculate($transactionTypeEnum, $sourceCurrency, $targetCurrency));
    }

    public function provideData(): array
    {
        return [
            [$this->getCalculatedAmountForSellTransaction(100, 1.5678), TransactionTypeEnum::SELL, new SourceCurrency(CurrencyCodeEnum::EUR, 100), new TargetCurrency(CurrencyCodeEnum::GBP)],
            [$this->getCalculatedAmountForBuyTransaction(100, 1.5432), TransactionTypeEnum::BUY, new SourceCurrency(CurrencyCodeEnum::GBP, 100), new TargetCurrency(CurrencyCodeEnum::EUR)],
            [$this->getCalculatedAmountForSellTransaction(100, 1.5432), TransactionTypeEnum::SELL, new SourceCurrency(CurrencyCodeEnum::GBP, 100), new TargetCurrency(CurrencyCodeEnum::EUR)],
            [$this->getCalculatedAmountForBuyTransaction(100, 1.5678), TransactionTypeEnum::BUY, new SourceCurrency(CurrencyCodeEnum::EUR, 100), new TargetCurrency(CurrencyCodeEnum::GBP)],
        ];
    }

    private function getCalculatedAmountForSellTransaction(float $value, float $rate): float
    {
        $value = $value * $rate;

        return round(($value + ($value * 0.01)), 3);
    }
    private function getCalculatedAmountForBuyTransaction(float $value, float $rate): float
    {
        $value = $value * $rate;

        return round(($value - ($value * 0.01)), 3);
    }
}
