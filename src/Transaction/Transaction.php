<?php

declare(strict_types=1);


namespace CurrencyExchange\Transaction;


use CurrencyExchange\Common\Domain\EntityInterface;
use CurrencyExchange\Transaction\Domain\Enum\TransactionTypeEnum;
use CurrencyExchange\Transaction\Domain\ValueObject\SourceCurrency;
use CurrencyExchange\Transaction\Domain\ValueObject\TargetCurrency;
use CurrencyExchange\User\User;
use Ramsey\Uuid\UuidInterface;

class Transaction implements EntityInterface
{
    public function __construct(
        private UuidInterface       $uuid,
        private User                $user,
        private TransactionTypeEnum $transactionType,
        private SourceCurrency    $sourceCurrency,
        private TargetCurrency    $targetCurrency,
    ) { 
    }

    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getTransactionType(): TransactionTypeEnum
    {
        return $this->transactionType;
    }

    public function getSourceCurrency(): SourceCurrency
    {
        return $this->sourceCurrency;
    }

    public function getTargetCurrency(): TargetCurrency
    {
        return $this->targetCurrency;
    }

    public function setTargetCurrencyAmount(float $amount): void
    {
        $this->targetCurrency->setAmount($amount);
    }
}