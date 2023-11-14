<?php

namespace Test\Unit\Transaction\Application\Factory;

use CurrencyExchange\Common\Domain\Enum\Exceptions\UnsupportedEnumValueException;
use CurrencyExchange\Transaction\Application\Factory\TransactionFactory;
use CurrencyExchange\Transaction\Application\Factory\TransactionTypePolicyFactory;
use CurrencyExchange\Transaction\Application\Service\AmountCalculator;
use CurrencyExchange\Transaction\Application\Service\AmountFormatter;
use CurrencyExchange\Transaction\Application\Service\CurrencyRateSelector;
use CurrencyExchange\Transaction\Domain\Command\CreateTransaction;
use CurrencyExchange\Transaction\Domain\Enum\CurrencyCodeEnum;
use CurrencyExchange\Transaction\Domain\Enum\TransactionTypeEnum;
use CurrencyExchange\Transaction\Transaction;
use PHPUnit\Framework\TestCase;
use Test\Mock\Transaction\Application\Service\CurrencyRatesProvider;
use Test\Mock\User\Infrastructure\Persistence\Default\UserRepositoryMock;

class TransactionFactoryTest extends TestCase
{
    public function testCreate(): void
    {
        $factory = $this->buildTransactionFactory();

        $userId = '1c27686b-1292-44e2-bdad-61b99dcd6321';   //existing user's id
        $transactionType = TransactionTypeEnum::BUY->value;
        $sourceCurrencyCode = CurrencyCodeEnum::EUR->value;
        $sourceCurrencyAmount = 1.0;
        $targetCurrencyCode = CurrencyCodeEnum::GBP->value;

        $command = new CreateTransaction($userId, $transactionType, $sourceCurrencyCode, $sourceCurrencyAmount, $targetCurrencyCode);

        $transaction = $factory->create($command);

        $this->assertInstanceOf(Transaction::class, $transaction);
        $this->assertSame($userId, $transaction->getUser()->getUuid()->toString());
        $this->assertSame($transactionType, $transaction->getTransactionType()->value);
        $this->assertSame($sourceCurrencyCode, $transaction->getSourceCurrency()->getCode()->value);
        $this->assertSame($sourceCurrencyAmount, $transaction->getSourceCurrency()->getAmount());
        $this->assertSame($targetCurrencyCode, $transaction->getTargetCurrency()->getCode()->value);
    }

    /**
     * @dataProvider provideInvalidEnums
     */
    public function testInvalidCurrencies(string $sourceCurrencyCode, string $targetCurrencyCode, string $transactionType): void
    {
        $commandMock = $this->createMock(CreateTransaction::class);
        $commandMock->method('getSourceCurrencyCode')->willReturn($sourceCurrencyCode);
        $commandMock->method('getTargetCurrencyCode')->willReturn($targetCurrencyCode);
        $commandMock->method('getTransactionType')->willReturn($transactionType);

        $factory = $this->buildTransactionFactory();

        $this->expectException(UnsupportedEnumValueException::class);
        $factory->create($commandMock);
    }

    public function provideInvalidEnums(): array
    {
        return [
            ['xxx', CurrencyCodeEnum::EUR->value, TransactionTypeEnum::BUY->value],
            [CurrencyCodeEnum::EUR->value, 'xxx', TransactionTypeEnum::BUY->value],
            [CurrencyCodeEnum::EUR->value, CurrencyCodeEnum::EUR->value, 'xxx'],
        ];
    }

    private function buildTransactionFactory(): TransactionFactory
    {
        return new TransactionFactory(
            new UserRepositoryMock(),
            new AmountCalculator(
                new CurrencyRateSelector(new CurrencyRatesProvider()),
                new TransactionTypePolicyFactory(),
                new AmountFormatter(),
            )
        );
    }
}
