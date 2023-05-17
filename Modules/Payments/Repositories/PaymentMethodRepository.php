<?php

namespace Modules\Payments\Repositories;

use Modules\Payments\Entities\PaymentMethod;

class PaymentMethodRepository
{
    public function create(array $data)
    {
        return PaymentMethod::create($data);
    }

    public function update(PaymentMethod $paymentMethod, array $data)
    {
        $paymentMethod->update($data);
        return $paymentMethod;
    }

    public function delete(PaymentMethod $paymentMethod)
    {
        $paymentMethod->delete();
    }

    public function getById($paymentMethodId)
    {
        return PaymentMethod::findOrFail($paymentMethodId);
    }

    public function getByUserId($userId)
    {
        return PaymentMethod::where('user_id', $userId)->get();
    }
}
