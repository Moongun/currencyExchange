<?php

declare(strict_types=1);

namespace Test\Unit\Transaction\Application\Factory;

use CurrencyExchange\Transaction\Application\Factory\TransactionTypePolicyFactory;
use CurrencyExchange\Transaction\Application\Service\Policy\BuyTransactionTypePolicy;
use CurrencyExchange\Transaction\Domain\Enum\TransactionTypeEnum;
use PHPUnit\Framework\TestCase;

class TransactionTypePolicyFactoryTest extends TestCase
{
    public function testCreatePolicy(): void
    {
        $factory = new TransactionTypePolicyFactory();

        $this->assertInstanceOf(BuyTransactionTypePolicy::class, $factory->create(TransactionTypeEnum::BUY));
    }

    public function testNotSupportedTransactionType(): void
    {
        $factory = $this->createMock(TransactionTypePolicyFactory::class);
        $factory->method('registeredPolicies')->willReturn([]);

        $this->assertNull($factory->create(TransactionTypeEnum::SELL));
    }
}
