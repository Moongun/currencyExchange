<?php

declare(strict_types=1);


namespace CurrencyExchange\Common\Domain\Repository\Exceptions;


use Exception;

class InvalidEntityException extends Exception
{
    public function __construct(string $entryClass, string $requiredClass)
    {
        $message = sprintf('Entity of class %s is not valid. Required: %s', $entryClass, $requiredClass);
        parent::__construct($message, 0, null);
    }
}