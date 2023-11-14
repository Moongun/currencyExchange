<?php

declare(strict_types=1);


namespace CurrencyExchange\Common\Domain\CommandHandler;


interface CommandHandlerInterface
{
    public function handle($command);
}