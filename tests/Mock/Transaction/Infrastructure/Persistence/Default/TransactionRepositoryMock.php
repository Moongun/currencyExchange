<?php

declare(strict_types=1);


namespace Test\Mock\Transaction\Infrastructure\Persistence\Default;


use CurrencyExchange\Transaction\Infrastructure\Persistence\Default\TransactionRepository;

class TransactionRepositoryMock extends TransactionRepository
{
    protected static array $transactions = [
        ['id' => '8acc78f5-6618-4e9e-83ff-dc10ec855efb', 'user_id' => '1c27686b-1292-44e2-bdad-61b99dcd6321', 'transaction_type' => 'BUY', 'source_currency_code' => 'EUR', 'source_currency_amount' => 10.0 , 'target_currency_code' => 'GBP', 'target_currency_amount' => 15.52122],
    ];
}