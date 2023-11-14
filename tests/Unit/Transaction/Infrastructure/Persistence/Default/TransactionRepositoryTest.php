<?php

declare(strict_types=1);

namespace Tests\Unit\Transaction\Infrastructure\Persistence\Default;

use CurrencyExchange\Common\Domain\Repository\Exceptions\EntityNotFoundException;
use PHPUnit\Framework\TestCase;
use Test\Mock\Transaction\Infrastructure\Persistence\Default\TransactionRepositoryMock;

class TransactionRepositoryTest extends TestCase
{
    public function testIfEntityExists(): void
    {
        $uuid = '8acc78f5-6618-4e9e-83ff-dc10ec855efb';

        $userRepository = new TransactionRepositoryMock();

        $user = $userRepository->find($uuid);

        $this->assertEquals($uuid, $user->getUuid()->toString());
    }

    public function testIfEntityNotExists(): void
    {
        $userRepository = new TransactionRepositoryMock();

        $this->expectException(EntityNotFoundException::class);
        $userRepository->find('invalid-uuid');
    }
}
