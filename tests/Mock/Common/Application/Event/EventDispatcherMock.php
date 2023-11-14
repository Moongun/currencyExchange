<?php

declare(strict_types=1);


namespace Test\Mock\Common\Application\Event;


use CurrencyExchange\Common\Domain\Event\EventDispatcherInterface;
use CurrencyExchange\Common\Domain\Event\EventInterface;
use CurrencyExchange\Transaction\Domain\Event\TransactionCreated;

class EventDispatcherMock implements EventDispatcherInterface
{
    public static array $events = [];

    public function dispatch(EventInterface $event): void
    {
        foreach ($this->registeredEvents() as $registeredEvent) {
            if ($event instanceof $registeredEvent) {
                self::$events[] = $event;
            }
        }
    }

    public function registeredEvents(): array
    {
        return [
            TransactionCreated::class
        ];
    }
}