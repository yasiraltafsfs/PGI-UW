<?php

namespace Modules\Payments\Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Payments\Http\Controllers\PaymentController;

class AddPaymentMethod extends TestCase
{
    /** 
     * A basic unit test example.
     *
     * @return void
     */
    public function test_create_payment_method()
    {
        $token = 'to_visa';
        $gateway = 'stripe';
        $method = 'cc';
        return true;
        // $method = new PaymentController();
        // $method = $method->addPaymentMethod($)

        
    }
}
