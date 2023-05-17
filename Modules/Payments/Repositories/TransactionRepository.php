<?php

namespace Modules\Payments\Repositories;

use Modules\Payments\Models\Transaction;

class TransactionRepository
{
    public function create(array $data)
    {
        return Transaction::create($data);
    }

    public function update(Transaction $transaction, array $data)
    {
        $transaction->update($data);
        return $transaction;
    }

    public function delete(Transaction $transaction)
    {
        $transaction->delete();
    }

    public function getById($transactionId)
    {
        return Transaction::findOrFail($transactionId);
    }

    public function getByUserId($userId)
    {
        return Transaction::where('user_id', $userId)->get();
    }
}
