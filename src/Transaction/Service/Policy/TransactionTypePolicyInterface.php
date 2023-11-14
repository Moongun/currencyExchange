<?php

declare(strict_types=1);


namespace CurrencyExchange\Transaction\Service\Policy;


use CurrencyExchange\Transaction\Domain\Enum\TransactionTypeEnum;

interface TransactionTypePolicyInterface
{
    public function apply(float &$amount): void;

    public function supports(TransactionTypeEnum $transactionTypeEnum): bool;
}