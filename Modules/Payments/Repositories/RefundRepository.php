<?php

namespace Modules\Payments\Repositories;

use Modules\Payments\Entities\Refund;
use Modules\Payments\Entities\Transaction;
use Modules\Payments\Entities\PaymentMethod;
use Modules\Payments\Contracts\RefundContract;
use Modules\Payments\Contracts\RefundRepositoryContract;

class RefundRepository implements RefundRepositoryContract
{
    public function create($data,$id)
    {
        $transaction = Transaction::findOrFail($id);
        if($data['status']=='completed'){
            $transaction->status = 'refunded';
            $transaction->save();
        }
        return Refund::create($data);

    }

    public function getAll()
    {
        return Refund::get();
    }

    public function getById($transactionId)
    {
        return Transaction::findOrFail($transactionId);
    }


}
