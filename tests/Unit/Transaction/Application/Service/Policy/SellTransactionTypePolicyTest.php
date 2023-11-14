<?php

namespace Test\Unit\Transaction\Application\Service\Policy;

use CurrencyExchange\Transaction\Application\Service\Policy\SellTransactionTypePolicy;
use PHPUnit\Framework\TestCase;

class SellTransactionTypePolicyTest extends TestCase
{
    public function testUpdateAmount()
    {
        $policy = new SellTransactionTypePolicy();

        $amount = 100;
        $policy->apply($amount);

        $this->assertEquals(101, $amount);
    }
}
