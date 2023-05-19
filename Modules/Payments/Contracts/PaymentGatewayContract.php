<?php
namespace Modules\Payments\Contracts;


interface PaymentGatewayContract
{
    public function addPaymentMethod($customerId, $paymentMethodToken);

    public function charge($customerId, $pmId, $amount);

    // public function voidTransaction($transactionId);

    public function refundTransaction($transactionId);

    public function saveCustomerProfile($customerId, $profileData);
    
    public function updateCustomerProfile($customerId, $profileData);

    public function setDefaultPaymentMethod($customerId, $pmId);

    public function unsetDefaultPaymentMethod($customerId);

    public function checkCustomerProfile($customerId);

    public function deleteCustomerProfile($customerId);
}