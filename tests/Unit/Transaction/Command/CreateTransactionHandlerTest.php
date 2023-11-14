<?php

namespace Test\Unit\Transaction\Command;

use CurrencyExchange\Transaction\Application\CommandHandler\CreateTransactionHandler;
use CurrencyExchange\Transaction\Domain\Command\CreateTransaction;
use CurrencyExchange\Transaction\Domain\Enum\CurrencyCodeEnum;
use CurrencyExchange\Transaction\Domain\Enum\TransactionTypeEnum;
use CurrencyExchange\Transaction\Domain\Event\TransactionCreated;
use CurrencyExchange\Transaction\Domain\ValueObject\SourceCurrency;
use CurrencyExchange\Transaction\Domain\ValueObject\TargetCurrency;
use CurrencyExchange\Transaction\Factory\TransactionFactoryInterface;
use CurrencyExchange\Transaction\Transaction;
use PHPUnit\Framework\TestCase;
use Test\Mock\Common\Application\Event\EventDispatcherMock;
use Test\Mock\Transaction\Infrastructure\Persistence\Default\TransactionRepositoryMock;

class CreateTransactionHandlerTest extends TestCase
{
    public function testHandle()
    {
        $transactionMock = $this->createConfiguredMock(
            Transaction::class,
            [
                'getTransactionType' => TransactionTypeEnum::BUY,
                'getSourceCurrency' => new SourceCurrency(CurrencyCodeEnum::EUR, 1),
                'getTargetCurrency' => new TargetCurrency(CurrencyCodeEnum::GBP),
            ]
        );

        $transactionFactoryMock = $this->createConfiguredMock(
            TransactionFactoryInterface::class,
            ['create' => $transactionMock]
        );

        $handler = new CreateTransactionHandler(
            new TransactionRepositoryMock(),
            $transactionFactoryMock,
            new EventDispatcherMock()
        );

        $this->assertEmpty(EventDispatcherMock::$events);

        $handler->handle($this->createStub(CreateTransaction::class));

        $this->assertNotEmpty(EventDispatcherMock::$events);
        $this->assertInstanceOf(TransactionCreated::class, EventDispatcherMock::$events[0]);
    }
}
