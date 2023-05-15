<?php

namespace Modules\Payments\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Payments\Factories\PaymentGatewayFatory;

class GatewayController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function transactions(){
        return view('payments::transactions');
        
    }
    public function refunds(){
        return view('payments::refunds');
        
    }
    public function createMethod(){
        return view('payments::create-method');
        
    }


    // public function createMethod(Request $request)
    // {
    //     // $request->validate([
    //     //     'gateway' => 'required',
    //     //     'method'  => 'required',
    //     //     'token'   => 'required'
    //     // ]);
    //     // try {
    //         dd(auth()->user()->name);
    //     // } catch (\Throwable $th) {
    //     //     return redirect()->back()->with();
    //     // }
    // }

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
    public function store(Request $request)
    {
        //
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
