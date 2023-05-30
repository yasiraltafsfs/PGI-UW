<?php
namespace Modules\Payments\Contracts;


interface PaymentRespositoryContract
{
    public function getPaymentMethods();
    public function getTransactions();
    public function getRefunds();
    public function getCustomerId($gateway);
    public function createCustomer($data);
    public function getPaymentGatewayId($gatewayId);
    public function addPaymentMethod($payload);
    public function setDefaultPaymentMethod($id);
    public function unsetDefaultPaymentMethod($id);
    public function removeMethod($id);
    public function refundTransaction($id);


    // public function charge($customerId, $paymentMethodToken, $amount);

    // // public function voidTransaction($transactionId);


    // public function saveCustomerProfile($customerId, $profileData);

    // public function updateCustomerProfile($customerId, $profileData);



    // public function checkCustomerProfile($customerId);

    // public function deleteCustomerProfile($customerId);
}