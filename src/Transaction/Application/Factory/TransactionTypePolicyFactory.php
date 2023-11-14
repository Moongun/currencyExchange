<?php

declare(strict_types=1);


namespace CurrencyExchange\Transaction\Application\Factory;


use CurrencyExchange\Transaction\Application\Service\Policy\BuyTransactionTypePolicy;
use CurrencyExchange\Transaction\Application\Service\Policy\SellTransactionTypePolicy;
use CurrencyExchange\Transaction\Domain\Enum\TransactionTypeEnum;
use CurrencyExchange\Transaction\Factory\TransactionTypePolicyFactoryInterface;
use CurrencyExchange\Transaction\Service\Policy\TransactionTypePolicyInterface;

class TransactionTypePolicyFactory implements TransactionTypePolicyFactoryInterface
{
    public function create(TransactionTypeEnum $transactionTypeEnum): ?TransactionTypePolicyInterface
    {
        foreach ($this->registeredPolicies() as $policy) {
            if ($policy->supports($transactionTypeEnum)) {
                return $policy;
            }
        }

        return null;
    }

    /**
     * @return TransactionTypePolicyInterface[]
     */
    public function registeredPolicies(): array
    {
        return [
            new SellTransactionTypePolicy(),
            new BuyTransactionTypePolicy(),
        ];
    }
}