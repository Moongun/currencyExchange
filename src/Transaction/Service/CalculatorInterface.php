<?php

declare(strict_types=1);


namespace CurrencyExchange\Transaction\Service;


use CurrencyExchange\Transaction\Domain\Enum\TransactionTypeEnum;
use CurrencyExchange\Transaction\Domain\ValueObject\SourceCurrency;
use CurrencyExchange\Transaction\Domain\ValueObject\TargetCurrency;

interface CalculatorInterface
{
    public function calculate(TransactionTypeEnum $transactionTypeEnum, SourceCurrency $sourceCurrency, TargetCurrency $targetCurrency): float;
}