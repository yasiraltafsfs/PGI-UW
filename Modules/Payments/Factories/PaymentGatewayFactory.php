<?php

namespace Modules\Payments\Factories;

use Modules\Payments\Services\StripePaymentGateway;

class PaymentGatewayFactory
{
    public static function create($gateway)
    {
        switch ($gateway) {
            case 'stripe':
                return new StripePaymentGateway();
            // Add cases for other payment gateways if needed
            default:
                throw new \InvalidArgumentException("Unsupported payment gateway: $gateway");
        }
    }
}