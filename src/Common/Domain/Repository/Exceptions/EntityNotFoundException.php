<?php

declare(strict_types=1);


namespace CurrencyExchange\Common\Domain\Repository\Exceptions;


use Exception;

class EntityNotFoundException extends Exception
{
    public function __construct(string $class)
    {
        $message = sprintf('Entity of class %s not found', $class);
        parent::__construct($message, 0, null);
    }
}