<?php

namespace Modules\Payments\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Payments\Contracts\TransactionContract;
use Modules\Payments\Factories\PaymentGatewayFactory as factory;


class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

     protected $transactionRepository;

     public function __construct(TransactionContract $transactionRepository)
     {
         $this->transactionRepository = $transactionRepository;
     }

    public function index()
    {
        $transactions = $this->transactionRepository->getAll();
        return view('payments::transactions',['transactions'=>$transactions]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $is_default = $this->transactionRepository->getDefaultMethod();

        return view('payments::create-charge',compact('is_default'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        try {
            $gateway_name = auth()->user()->defaultPaymentMethod->paymentGateway->gateway_name;
            $customerId = auth()->user()->defaultPaymentMethod->paymentGateway->gateway_id;
            $pmId = auth()->user()->defaultPaymentMethod->payment_method_id;
            $amount = $request->amount;
            $gateway_obj = factory::create($gateway_name);
            $charge = $gateway_obj->charge( $customerId,$pmId,$amount);
                $payload = [
                    'user_id'           =>  auth()->user()->id,
                    'payment_method_id' =>  auth()->user()->defaultPaymentMethod->id,
                    'transaction_id'    =>  $charge->id,
                    'amount'            =>  $charge->amount,
                    'status'            =>  $charge->status == 'succeeded' ? 'completed' : 'failed'
                ];
                $this->transactionRepository->create($payload);
            if($charge->status == 'succeeded'){
                return redirect()->route('transactions')->with('success', 'Payment '.$amount.' charged  successfully');
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
