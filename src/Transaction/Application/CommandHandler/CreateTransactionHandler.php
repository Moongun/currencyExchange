<?php

declare(strict_types=1);


namespace CurrencyExchange\Transaction\Application\CommandHandler;


use CurrencyExchange\Common\Domain\CommandHandler\CommandHandlerInterface;
use CurrencyExchange\Common\Domain\CommandHandler\Exceptions\CommandHandlerException;
use CurrencyExchange\Common\Domain\Event\EventDispatcherInterface;
use CurrencyExchange\Transaction\Domain\Command\CreateTransaction;
use CurrencyExchange\Transaction\Domain\Event\TransactionCreated;
use CurrencyExchange\Transaction\Factory\TransactionFactoryInterface;
use CurrencyExchange\Transaction\Repository\TransactionRepositoryInterface;
use Exception;

class CreateTransactionHandler implements CommandHandlerInterface
{
    public function __construct(
        private TransactionRepositoryInterface $transactionRepository,
        private TransactionFactoryInterface $transactionFactory,
        private EventDispatcherInterface $eventDispatcher,
    ) {
    }

    /**
     * @param CreateTransaction $createTransaction
     */
    public function handle($createTransaction): void
    {
        try {
            $transaction = $this->transactionFactory->create($createTransaction);

            $this->transactionRepository->save($transaction);

            $this->eventDispatcher->dispatch(new TransactionCreated($transaction));

        } catch (Exception $exception) {
            throw new CommandHandlerException($createTransaction::class, $exception->getMessage());
        }
    }
}