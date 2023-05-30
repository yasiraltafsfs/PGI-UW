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
    public function createPaymentMethod()
    {
        $token = 'to_visa';
        $gateway = 'stripe';
        $method = 'cc';

        $method = new PaymentController();
        $method = $method->addPaymentMethod($)

        
    }
}
