<?php

declare(strict_types=1);


namespace CurrencyExchange\Transaction\Application\Service\Policy;


use CurrencyExchange\Transaction\Domain\Enum\TransactionTypeEnum;
use CurrencyExchange\Transaction\Service\Policy\TransactionTypePolicyInterface;

class SellTransactionTypePolicy implements TransactionTypePolicyInterface
{
    public function apply(float &$amount): void
    {
        $amount += ($amount * 0.01);
    }

    public function supports(TransactionTypeEnum $transactionTypeEnum): bool
    {
        return $transactionTypeEnum === TransactionTypeEnum::SELL;
    }
}