<?php

declare(strict_types=1);


namespace CurrencyExchange\Transaction\Infrastructure\Persistence\Default;


use CurrencyExchange\Common\Domain\EntityInterface;
use CurrencyExchange\Common\Domain\Repository\Exceptions\EntityNotFoundException;
use CurrencyExchange\Common\Domain\Repository\Exceptions\InvalidEntityException;
use CurrencyExchange\Transaction\Domain\Enum\CurrencyCodeEnum;
use CurrencyExchange\Transaction\Domain\Enum\TransactionTypeEnum;
use CurrencyExchange\Transaction\Domain\ValueObject\SourceCurrency;
use CurrencyExchange\Transaction\Domain\ValueObject\TargetCurrency;
use CurrencyExchange\Transaction\Repository\TransactionRepositoryInterface;
use CurrencyExchange\Transaction\Transaction;
use CurrencyExchange\User\User;
use Ramsey\Uuid\Uuid;

class TransactionRepository implements TransactionRepositoryInterface
{
    protected static array $transactions = [];

    public function find(string $uuid): Transaction
    {
        foreach(static::$transactions as $data) {
            if ($data['id'] === $uuid) {
                return new Transaction(
                    uuid: Uuid::fromString($data['id']),
                    user: new User(Uuid::fromString($data['user_id'])),
                    transactionType: TransactionTypeEnum::from($data['transaction_type']),
                    sourceCurrency: new SourceCurrency(CurrencyCodeEnum::from($data['source_currency_code']), $data['source_currency_amount']),
                    targetCurrency: new TargetCurrency(CurrencyCodeEnum::from($data['target_currency_code']), $data['target_currency_amount']),
                );
            }
        }

        throw new EntityNotFoundException(Transaction::class);
    }

    public function save(EntityInterface $entity): void
    {
        if (!$entity instanceof Transaction) {
            throw  new InvalidEntityException($entity::class, Transaction::class);
        }

        static::$transactions[] = [
            'id' => $entity->getUuid()->toString(),
            'user_id' => $entity->getUser()->getUuid()->toString(),
            'transaction_type' => $entity->getTransactionType()?->value,
            'source_currency_code' => $entity->getSourceCurrency()->getCode()->value,
            'source_currency_amount' => $entity->getSourceCurrency()->getAmount(),
            'target_currency_code' => $entity->getTargetCurrency()->getCode()->value,
            'target_currency_amount' => $entity->getTargetCurrency()->getAmount(),
        ];
    }
}