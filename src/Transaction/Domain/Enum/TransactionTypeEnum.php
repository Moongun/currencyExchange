<?php

namespace CurrencyExchange\Transaction\Domain\Enum;

enum TransactionTypeEnum: string
{
    case BUY = 'BUY';
    case SELL = 'SELL';
}
