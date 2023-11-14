<?php

declare(strict_types=1);


namespace CurrencyExchange\Transaction\Domain\Command;


class CreateTransaction
{
    public function __construct(
        private string $userId,
        private string  $transactionType,
        private string $sourceCurrencyCode,
        private float $sourceCurrencyAmount,
        private string $targetCurrencyCode,
    ) { 
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getTransactionType(): string
    {
        return $this->transactionType;
    }

    public function getSourceCurrencyCode(): string
    {
        return $this->sourceCurrencyCode;
    }

    public function getSourceCurrencyAmount(): float
    {
        return $this->sourceCurrencyAmount;
    }

    public function getTargetCurrencyCode(): string
    {
        return $this->targetCurrencyCode;
    }
}