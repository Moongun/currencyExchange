<?php

declare(strict_types=1);


namespace Test\Mock\User\Infrastructure\Persistence\Default;

use CurrencyExchange\User\Infrastructure\Persistance\Default\UserRepository;

class UserRepositoryMock extends UserRepository
{
    protected static array $users = [
        ['id' => '1c27686b-1292-44e2-bdad-61b99dcd6321'],
    ];
}