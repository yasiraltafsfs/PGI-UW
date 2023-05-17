<?php

namespace Modules\Payments\Http\Controllers;

use Modules\Payments\Repositories\PaymentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Payments\Factories\PaymentGatewayFactory as factory;

class PaymentController extends Controller
{
    protected $paymentRepository;

    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }
    
    public function index()
    {
        return view('payments::index');
    }

    public function showAddPaymentMethodForm()
    {
        return view('payments::index');
    }

    public function addPaymentMethod(Request $request)
    {
        // Validate the request data
        // $request->validate([
        //     'customer_id' => 'required',
        //     'token' => 'required',
        // ]);
        $customerId = "cus_sdsdsfwer4rwef";
        $paymentMethodToken = "tok_visa";
        // $customerId = $request->input('customer_id');
        // $paymentMethodToken = $request->input('payment_method_token');
        // $gateway = factory::create('stripe');
        // dd($gateway);


        // Add the payment method
        $paymentMethod = $this->paymentRepository->addPaymentMethod($customerId, $paymentMethodToken);
        dd($paymentMethod);

        return redirect()->back()->with('success', 'Payment method added successfully');
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

    // Add other methods for voiding/refunding transactions, updating customer profiles, etc.
}
