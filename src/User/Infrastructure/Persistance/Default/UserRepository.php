<?php

declare(strict_types=1);


namespace CurrencyExchange\User\Infrastructure\Persistance\Default;

use CurrencyExchange\Common\Domain\EntityInterface;
use CurrencyExchange\Common\Domain\Repository\Exceptions\EntityNotFoundException;
use CurrencyExchange\User\Repository\UserRepositoryInterface;
use CurrencyExchange\User\User;
use Ramsey\Uuid\Uuid;

class UserRepository implements UserRepositoryInterface
{
    private static array $users = [];

    public function find(string $uuid): User
    {
        foreach(static::$users as $data) {
            if ($data['id'] === $uuid) {
                return new User(Uuid::fromString($data['id']));
            }
        }

        throw new EntityNotFoundException(User::class);
    }

    public function save(EntityInterface $entity): void
    {
        // not needed
    }
}