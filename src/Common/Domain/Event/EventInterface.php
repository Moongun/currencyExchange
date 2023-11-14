<?php

declare(strict_types=1);


namespace CurrencyExchange\Common\Domain\Event;


interface EventInterface
{
    public function details(): array;
}