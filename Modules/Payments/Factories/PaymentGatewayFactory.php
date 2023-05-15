<?php
namespace Modules\Payments\Factories;
use Modules\Payments\Services\Strpe;
use Modules\Payments\Contacts\PaymentGatewayContract;


class PaymentGatewayFatory 
{
    public function getPaymentGateWay($gateway):PaymentGatewayContract{
        switch ($gateway) {
            case 'stripe':
                return new Strpe; 
                break;
            case 'stripe':
                return new Strpe; 
                break;
            default:
                return "Select A Payment Gateway";
                break;
        }
    }
    
}
