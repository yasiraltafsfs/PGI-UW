<?php
namespace Modules\Payments\Contracts;


interface PaymentGatewayContract
{
    public function addPaymentMethod($customerId, $paymentMethodToken);

    public function charge($customerId, $paymentMethodToken, $amount);

    public function voidTransaction($transactionId);

    public function refundTransaction($transactionId);

    public function saveCustomerProfile($customerId, $profileData);

    public function updateCustomerProfile($customerId, $profileData);

    public function setDefaultPaymentMethod($customerId, $paymentMethodToken);

    public function unsetDefaultPaymentMethod($customerId, $paymentMethodToken);

    public function checkCustomerProfile($customerId);

    public function deleteCustomerProfile($customerId);
}