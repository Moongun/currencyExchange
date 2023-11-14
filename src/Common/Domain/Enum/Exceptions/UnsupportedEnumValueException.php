<?php

declare(strict_types=1);


namespace CurrencyExchange\Common\Domain\Enum\Exceptions;


use Exception;

class UnsupportedEnumValueException extends Exception
{
    public function __construct(string $message)
    {
        parent::__construct(sprintf("Unsupported enum value. Error message: %s", $message), 0, null);
    }
}