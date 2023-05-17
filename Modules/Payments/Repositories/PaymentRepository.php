<?php

namespace Modules\Payments\Repositories;

use Modules\Payments\Contracts\PaymentGatewayContract;
use Modules\Payments\PaymentGateways\PaymentGatewayFactory;

class PaymentRepository
{
    protected $gateway;

    public function __construct(PaymentGatewayContract $gateway)
    {
        $this->gateway = $gateway;
    }

    public function addPaymentMethod($customerId, $paymentMethodToken)
    {
        return $this->gateway->addPaymentMethod($customerId, $paymentMethodToken);
    }

    public function charge($customerId, $paymentMethodToken, $amount)
    {
        return $this->gateway->charge($customerId, $paymentMethodToken, $amount);
    }

    public function voidTransaction($transactionId)
    {
        return $this->gateway->voidTransaction($transactionId);
    }

    public function refundTransaction($transactionId)
    {
        return $this->gateway->refundTransaction($transactionId);
    }

    public function saveCustomerProfile($customerId, $profileData)
    {
        return $this->gateway->saveCustomerProfile($customerId, $profileData);
    }

    public function updateCustomerProfile($customerId, $profileData)
    {
        return $this->gateway->updateCustomerProfile($customerId, $profileData);
    }

    public function setDefaultPaymentMethod($customerId, $paymentMethodToken)
    {
        return $this->gateway->setDefaultPaymentMethod($customerId, $paymentMethodToken);
    }

    public function unsetDefaultPaymentMethod($customerId, $paymentMethodToken)
    {
        return $this->gateway->unsetDefaultPaymentMethod($customerId, $paymentMethodToken);
    }

    public function checkCustomerProfile($customerId)
    {
        return $this->gateway->checkCustomerProfile($customerId);
    }

    public function deleteCustomerProfile($customerId)
    {
        return $this->gateway->deleteCustomerProfile($customerId);
    }
}
