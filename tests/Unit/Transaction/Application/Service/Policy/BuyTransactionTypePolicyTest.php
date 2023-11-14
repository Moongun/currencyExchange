<?php

namespace Test\Unit\Transaction\Application\Service\Policy;

use CurrencyExchange\Transaction\Application\Service\Policy\BuyTransactionTypePolicy;
use PHPUnit\Framework\TestCase;

class BuyTransactionTypePolicyTest extends TestCase
{
    public function testUpdateAmount()
    {
        $policy = new BuyTransactionTypePolicy();

        $amount = 100;
        $policy->apply($amount);

        $this->assertEquals(99, $amount);
    }
}
