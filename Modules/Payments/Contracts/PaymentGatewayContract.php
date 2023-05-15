<?php
namespace Modules\Payments\Contracts;


interface PaymentGatewayContract {

public function createCustomer($data):object;

}