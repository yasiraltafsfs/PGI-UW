<?php

namespace Modules\Payments\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Payments\Contracts\RefundRepositoryContract;
use Modules\Payments\Factories\PaymentGatewayFactory as factory;



class RefundController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

     protected $refundRepository;

     public function __construct(RefundRepositoryContract $refundRepository)
     {
         $this->refundRepository = $refundRepository;
     }

    public function index()
    {
        $refunds = $this->refundRepository->getAll();
        // dd($refunds[0]->paymentMethod->paymentGateway);
        
        return view('payments::refunds',['refunds'=>$refunds]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('payments::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store($id)
    {
        try {
            // make refund on gate way
                
                $transaction  = $this->refundRepository->getById($id);
                $gatway_name = $transaction->paymentMethod->paymentGateway->gateway_name;
                $gateway_object = factory::create($gatway_name);
                $refund = $gateway_object->refundTransaction($transaction->transaction_id);
                $payload = [
                    'user_id' => auth()->user()->id,
                    'payment_method_id' =>  $transaction->paymentMethod->id,
                    'status' => $refund->status=="succeeded" ? 'completed' : 'pending',
                    'refund_id' => $refund->id
                ];
                $refund_model  = $this->refundRepository->create($payload,$id);
                if($refund->status == 'succeeded'){
                    return redirect()->route('transactions')->with('success', 'Refunded  successfully');
                }else{
                    return redirect()->route('transactions')->with('error', 'Not refunded');
                }

        } catch (\Exception $e) {
            return $e->getMessage();
        }
        
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('payments::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('payments::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
