<?php

namespace Modules\Payments\Repositories;

use Modules\Payments\Entities\Transaction;
use Modules\Payments\Entities\PaymentMethod;
use Modules\Payments\Contracts\TransactionContract;

class TransactionRepository implements TransactionContract
{
    public function create($data)
    {
        return Transaction::create($data);
    }

    public function update(Transaction $transaction,$data)
    {
        $transaction->update($data);
        return $transaction;
    }

    public function getById($transactionId)
    {
        return Transaction::findOrFail($transactionId);
    }

    public function getAll()
    {
        return Transaction::userSpecific()->get();
    }

    public function getDefaultMethod()
    {
        return PaymentMethod::userSpecific()->where('is_default',true)->first();
    }

}
