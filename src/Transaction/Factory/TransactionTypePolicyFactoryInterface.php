<?php

declare(strict_types=1);


namespace CurrencyExchange\Transaction\Factory;


use CurrencyExchange\Transaction\Domain\Enum\TransactionTypeEnum;
use CurrencyExchange\Transaction\Service\Policy\TransactionTypePolicyInterface;

interface TransactionTypePolicyFactoryInterface
{
    public function create(TransactionTypeEnum $transactionTypeEnum): ?TransactionTypePolicyInterface;

    /**
     * @return TransactionTypePolicyInterface[]
     */
    public function registeredPolicies(): array;
}