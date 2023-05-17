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
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    public function addPaymentMethod($customerId, $paymentMethodToken)
    {
        $paymentMethod = PaymentMethod::retrieve($paymentMethodToken);
        $paymentMethod->attach(['customer' => $customerId]);
    }

    public function charge($customerId, $paymentMethodToken, $amount)
    {
        $charge = Charge::create([
            'customer' => $customerId,
            'payment_method' => $paymentMethodToken,
            'amount' => $amount,
            'currency' => 'usd',
            'confirmation_method' => 'automatic',
            'confirm' => true,
            'fraud_details' => [
                'user_report' => 'safe', // Implement your fraud detection logic here
            ],
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

    public function setDefaultPaymentMethod($customerId, $paymentMethodToken)
    {
        $customer = Customer::update($customerId, [
            'invoice_settings' => [
                'default_payment_method' => $paymentMethodToken,
            ],
        ]);
        
        return $customer;
    }

    public function unsetDefaultPaymentMethod($customerId, $paymentMethodToken)
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
