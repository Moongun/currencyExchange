<?php

declare(strict_types=1);


namespace CurrencyExchange\Transaction\Application\Service;


use CurrencyExchange\Transaction\Domain\Enum\TransactionTypeEnum;
use CurrencyExchange\Transaction\Domain\ValueObject\SourceCurrency;
use CurrencyExchange\Transaction\Domain\ValueObject\TargetCurrency;
use CurrencyExchange\Transaction\Factory\TransactionTypePolicyFactoryInterface;
use CurrencyExchange\Transaction\Service\CalculatorInterface;
use CurrencyExchange\Transaction\Service\CurrencyRateSelectorInterface;
use CurrencyExchange\Transaction\Service\ValueFormatterInterface;

class AmountCalculator implements CalculatorInterface
{
    public function __construct(
        private CurrencyRateSelectorInterface         $currencyRates,
        private TransactionTypePolicyFactoryInterface $policyFactory,
        private ValueFormatterInterface               $valueFormatter,
    ) { 
    }

    public function calculate(TransactionTypeEnum $transactionTypeEnum, SourceCurrency $sourceCurrency, TargetCurrency $targetCurrency) : float
    {
        $rate = $this->currencyRates->select($sourceCurrency->getCode(), $targetCurrency->getCode());
        $amount = $sourceCurrency->getAmount() * $rate->getRate();

        $policy = $this->policyFactory->create($transactionTypeEnum);

        if ($policy) {
            $policy->apply($amount);
        }

        return $this->valueFormatter->format($amount);
    }
}