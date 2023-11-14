<?php

declare(strict_types=1);


namespace CurrencyExchange\Transaction\Application\Factory;


use CurrencyExchange\Common\Domain\Enum\Exceptions\UnsupportedEnumValueException;
use CurrencyExchange\Transaction\Domain\Command\CreateTransaction;
use CurrencyExchange\Transaction\Domain\Enum\CurrencyCodeEnum;
use CurrencyExchange\Transaction\Domain\Enum\TransactionTypeEnum;
use CurrencyExchange\Transaction\Domain\ValueObject\SourceCurrency;
use CurrencyExchange\Transaction\Domain\ValueObject\TargetCurrency;
use CurrencyExchange\Transaction\Factory\TransactionFactoryInterface;
use CurrencyExchange\Transaction\Service\CalculatorInterface;
use CurrencyExchange\Transaction\Transaction;
use CurrencyExchange\User\Repository\UserRepositoryInterface;
use Ramsey\Uuid\Uuid;
use ValueError;

class TransactionFactory implements TransactionFactoryInterface
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private CalculatorInterface     $calculator,
    ) {
    }

    public function create(CreateTransaction $createTransaction): Transaction
    {
        try {
            $sourceCurrencyCodeEnum = CurrencyCodeEnum::from($createTransaction->getSourceCurrencyCode());
            $targetCurrencyCodeEnum = CurrencyCodeEnum::from($createTransaction->getTargetCurrencyCode());
            $transactionTypeEnum = TransactionTypeEnum::from($createTransaction->getTransactionType());
        } catch (ValueError $error) {
            throw new UnsupportedEnumValueException($error->getMessage());
        }

        $sourceCurrency = new SourceCurrency(
            $sourceCurrencyCodeEnum,
            $createTransaction->getSourceCurrencyAmount()
        );

        $targetCurrency = new TargetCurrency($targetCurrencyCodeEnum);

        $createTransaction = new Transaction(
            uuid: Uuid::uuid4(),
            user: $this->userRepository->find($createTransaction->getUserId()),
            transactionType: $transactionTypeEnum,
            sourceCurrency: $sourceCurrency,
            targetCurrency: $targetCurrency,
        );

        $amount = $this->calculator->calculate($transactionTypeEnum, $sourceCurrency, $targetCurrency);
        $createTransaction->setTargetCurrencyAmount($amount);

        return $createTransaction;
    }
}