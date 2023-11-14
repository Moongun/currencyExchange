<?php

declare(strict_types=1);


namespace Tests\Unit\User\Infrastructure\Persistence\Default;


use CurrencyExchange\Common\Domain\Repository\Exceptions\EntityNotFoundException;
use PHPUnit\Framework\TestCase;
use Test\Mock\User\Infrastructure\Persistence\Default\UserRepositoryMock;

class UserRepositoryTest extends TestCase
{
    public function testIfEntityExists(): void
    {
        $uuid = '1c27686b-1292-44e2-bdad-61b99dcd6321';

        $userRepository = new UserRepositoryMock();

        $user = $userRepository->find($uuid);

        $this->assertEquals($uuid, $user->getUuid()->toString());
    }

    public function testIfEntityNotExists(): void
    {
        $userRepository = new UserRepositoryMock();

        $this->expectException(EntityNotFoundException::class);
        $userRepository->find('invalid-uuid');
    }
}