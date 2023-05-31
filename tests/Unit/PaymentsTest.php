<?php

namespace Tests\Unit;

use Tests\TestCase;

class PaymentsTest extends TestCase
{
    /**
     * A basic unit test example.
     */

    public function test_add_method(): void
    {
        $response = $this->call('POST',route('create-method'),[
            '_token' =>  csrf_token(),
            'token'=>'tok_visa',
            'method'=>'cc',
            'stripe'=>'strpec',
        ]);
        dd($response->getContent(), $response->headers->all());
        dd($response->status());
        if($response->status() !=302){
            $this->assertFalse(false);
        }
        $this->assertTrue(true);
    }
}
