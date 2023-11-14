<?php

declare(strict_types=1);


namespace CurrencyExchange\Common\Domain\CommandHandler\Exceptions;


use Exception;

class CommandHandlerException extends Exception
{
    public function __construct(string $commandClass, string $message)
    {
        $message = sprintf('Something went wrong during command handling: (%s) $s', $commandClass, $message);
        parent::__construct($message, 0, null);
    }
}