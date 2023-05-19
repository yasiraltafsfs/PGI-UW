<?php

namespace Modules\Payments\Services;

use Modules\Payments\Contracts\PaymentGatewayContract;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\PaymentMethod;
use Stripe\Charge;
use Stripe\Refund;

class StripePaymentGateway implements PaymentGatewayContract
{
    public function __construct()
    {
        // Initialize Stripe with your API key
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
    }

    public function fetchCustomer($customerId){
        return Customer::retrieve(['id'=>$customerId]);
    }

    public function createCustomer($name,$email)
    {
        $data = [
            'name' => $name,
            'email' => $email,
        ];
        return Customer::create($data);
    }

    public function addPaymentMethod($customerID,$token){
        $customer = $this->fetchCustomer($customerID);
        $card = $customer->createSource(
                        $customerID,
                        ['source' => $token]
                    );
        return $card;
    }

    public function charge($customerId, $pmId, $amount)
    {
        $charge = Charge::create([
            'customer' => $customerId,
            'source' => $pmId,
            'amount' => $amount,
            'currency' => 'usd',
            // 'confirmation_method' => 'automatic',
            // 'confirm' => true,
            // 'fraud_details' => [
            //     'user_report' => 'safe', // Implement your fraud detection logic here
            // ],
        ]);
        return $charge;
    }

    public function voidTransaction($transactionId)
    {
        $charge = Charge::retrieve($transactionId);
        $charge->refund();
    }

    public function refundTransaction($transactionId)
    {
        $refund = Refund::create([
            'charge' => $transactionId,
        ]);

        return $refund;
    }

    public function saveCustomerProfile($customerId, $profileData)
    {
        $customer = Customer::update($customerId, $profileData);
        return $customer;
    }

    public function updateCustomerProfile($customerId, $profileData)
    {
        $customer = Customer::update($customerId, $profileData);
        return $customer;
    }

    public function setDefaultPaymentMethod($customerId, $pmId)
    {
        $customer = Customer::update($customerId, [
            'invoice_settings' => [
                'default_payment_method' => $pmId,
            ],
        ]);
        
        return $customer;
    }

    public function unsetDefaultPaymentMethod($customerId)
    {
        $customer = Customer::update($customerId, [
            'invoice_settings' => [
                'default_payment_method' => null,
            ],
        ]);

        return $customer;
    }

    public function checkCustomerProfile($customerId)
    {
        $customer = Customer::retrieve($customerId);
        return $customer;
    }

    public function deleteCustomerProfile($customerId)
    {
        $customer = Customer::retrieve($customerId);
        $customer->delete();
    }
}
