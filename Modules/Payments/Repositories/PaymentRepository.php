<?php

namespace Modules\Payments\Repositories;

use Modules\Payments\Entities\Transaction;
use Modules\Payments\Entities\PaymentGateway;
use Modules\Payments\Entities\PaymentMethod;
use Modules\Payments\Entities\Refund;
use Modules\Payments\Contracts\PaymentRespositoryContract;

class PaymentRepository implements PaymentRespositoryContract
{
    public function getPaymentMethods(){
        return PaymentGateway::select('*')->userSpecific()->with('paymentMethods')->get();
    }

    public function getTransactions(){
        return Transaction::all();
    }

    public function getRefunds(){
        return Refund::all();
    }

    public function getCustomerId($gateway){
        return PaymentGateway::select('gateway_id')->where('gateway_name',$gateway)->userSpecific()->latest()->firstOrFail();
    }

    public function createCustomer($data){
        return PaymentGateway::create($data);
    }

    public function getPaymentGatewayId($gatewayId){
        return PaymentGateway::where('gateway_id',$gatewayId)->pluck('id')->first();
    }

    public function addPaymentMethod($payload)
    {
        return PaymentMethod::create($payload);
    }


    public function setDefaultPaymentMethod($id)
    {
        $method = PaymentMethod::userSpecific()->where('is_default',true)->first();
        if(!empty($method)){
            $method->is_default = false;
            $method->save();
        }
        $set_method = PaymentMethod::find($id);
        $set_method->is_default = true;
        $set_method->save();
        return $set_method;

    }

    public function unsetDefaultPaymentMethod($id)
    {
        $method = PaymentMethod::find($id);
        $method->is_default = false;
        $method->save();
        return $method;
    }

    public function removeMethod($id){
        $method = PaymentMethod::find($id);
        $method->delete();
        return $method;
    }
















    public function charge($customerId, $paymentMethodToken, $amount)
    {
        return $this->gateway->charge($customerId, $paymentMethodToken, $amount);
    }

    public function voidTransaction($transactionId)
    {
        return $this->gateway->voidTransaction($transactionId);
    }

    public function refundTransaction($transactionId)
    {
        return $this->gateway->refundTransaction($transactionId);
    }

    public function saveCustomerProfile($customerId, $profileData)
    {
        return $this->gateway->saveCustomerProfile($customerId, $profileData);
    }

    public function updateCustomerProfile($customerId, $profileData)
    {
        return $this->gateway->updateCustomerProfile($customerId, $profileData);
    }




    public function checkCustomerProfile($customerId)
    {
        return $this->gateway->checkCustomerProfile($customerId);
    }

    public function deleteCustomerProfile($customerId)
    {
        return $this->gateway->deleteCustomerProfile($customerId);
    }
}
