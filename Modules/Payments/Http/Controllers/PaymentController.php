<?php

namespace Modules\Payments\Http\Controllers;

use Modules\Payments\Contracts\PaymentRespositoryContract;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Payments\Factories\PaymentGatewayFactory as factory;

class PaymentController extends Controller
{
    protected $paymentRepository;

    public function __construct(PaymentRespositoryContract $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function index()
    {
        try {
                $methods = $this->paymentRepository->getPaymentMethods();
                return view('payments::index',['methods'=>$methods]);
                
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        
    }

    public function refunds(Request $request){
        $refunds = $this->paymentRepository->getRefunds();
        return view('payments::refunds',['refunds'=>$refunds]);
    }

    public function showAddPaymentMethodForm()
    {
        return view('payments::create-method');
    }

    public function addPaymentMethod(Request $request)
    {
        // Validate the request data
        $request->validate([
            'token' => 'required',
            'gateway' => 'required',
            'method' => 'required',
        ]);
        try {
            // get appropriate customer id
            $customerId = $this->getCustomerId($request->gateway,$request->method);
            // return respons()->json(['status' =>200, 'customerId' =>$customerId]);
            // Add the payment method
            $gateway_object = factory::create($request->gateway);
            $method =  $gateway_object->addPaymentMethod($customerId,$request->token);
            $payment_gateway_id = $this->paymentRepository->getPaymentGatewayId($customerId);
            $payload = ['user_id'=>auth()->user()->id,'payment_gateway_id'=>$payment_gateway_id,'payment_method'=>$request->method,'payment_method_id'=>$method->id];
            $paymentMethod = $this->paymentRepository->addPaymentMethod($payload);
            return redirect()->route('methods')->with('success', 'Payment method added successfully');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
 
    }
    public function getCustomerId($gateway){
        $customerId = $this->paymentRepository->getCustomerId($gateway);
        if(empty($customerId)){
            $customerId = $this->createCustomer($gateway);
            
        }
        return $customerId->gateway_id;
    }

    public function createCustomer($gateway){
        $gateway_obj = factory::create($gateway);
        $customer = $gateway_obj->createCustomer(auth()->user()->name,auth()->user()->email);
        $data = ['user_id'=>auth()->user()->id,'gateway_name' => $gateway,'gateway_id'=>$customer->id];
        return $this->paymentRepository->createCustomer($data);
    }

    public function removePaymentMethod($id){
        $method = $this->paymentRepository->removeMethod($id);
        if($method){
            return redirect()->back()->with('success', 'Payment method removed from default successfully');
        }else{
            return redirect()->back()->with('error', 'something went wrong');
        }
    }
    public function addDefault($id){
        $makeDefault = $this->paymentRepository->setDefaultPaymentMethod($id);  
        if($makeDefault){
            $gateway = factory::create($makeDefault->paymentGateway->gateway_name);
            $gateway->setDefaultPaymentMethod($makeDefault->paymentGateway->gateway_id,$makeDefault->payment_method_id);
            return redirect()->back()->with('success', 'Payment method set default successfully');
        }  
        else{
            return redirect()->back()->with('error', 'something went wrong');
        } 
    }

    public function removeDefault($id){
        $unsetDefault = $this->paymentRepository->unsetDefaultPaymentMethod($id);
        if($unsetDefault){
            $gateway = factory::create($unsetDefault->paymentGateway->gateway_name);
            $gateway->unsetDefaultPaymentMethod($unsetDefault->paymentGateway->gateway_id);
            return redirect()->back()->with('success', 'Payment method removed from default successfully');
        }  
        else{
            return redirect()->back()->with('error', 'something went wrong');
        } 
    }




































    public function showChargePaymentForm()
    {
        return view('payment.charge-payment');
    }

    public function charge(Request $request)
    {
        // Validate the request data
        $request->validate([
            'customer_id' => 'required',
            'payment_method_token' => 'required',
            'amount' => 'required|numeric',
        ]);

        $customerId = $request->input('customer_id');
        $paymentMethodToken = $request->input('payment_method_token');
        $amount = $request->input('amount');

        // Charge the payment method
        $transaction = $this->paymentRepository->charge($customerId, $paymentMethodToken, $amount);
        return redirect()->back()->with('success', 'Payment charged successfully');
    }


}
