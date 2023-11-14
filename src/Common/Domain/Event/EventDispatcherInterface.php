<?php

declare(strict_types=1);


namespace CurrencyExchange\Common\Domain\Event;


interface EventDispatcherInterface
{
    public function dispatch(EventInterface $event): void;

    public function registeredEvents(): array;
}