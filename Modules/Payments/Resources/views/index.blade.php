@extends('payments::layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="{{route('methods')}}">PAYMENTS</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                  <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                      <a class="nav-link" href="{{route('methods')}}">Methods <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('transactions')}}">Transactions</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('refunds')}}">Refunds</a>
                    </li>
                  </ul>
                </div>
            </nav>
        </div>
    </div>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    <div class="row mt-5">
      <div class="col-6">
        <h1>
          Methods  List
       </h1>
      </div>
      <div class="col-6">
        <a class="btn btn-primary" style="float: right" href="{{route('create-method')}}">
          + Add Payment Method
        </a>
      </div>
    </div>
    <div class="row">
    
        <div class="col-12">

          <table class="table table-bordered table-hover mt-2">
            <thead class="thead-dark"> 
              <tr>
                <th>Gateway Name</th>
                <th>Method <small>( CC/ACH )</small></th>
                <th>Method ID</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @if(count($methods) > 0)
                @foreach ($methods as $method)
                @foreach($method->paymentMethods as $paymentMethod)
                <tr>
                  <td>{{$method->gateway_name}}</td>
                  <td>{{$paymentMethod->payment_method}} </td>
                  <td>{{$paymentMethod->payment_method_id}}</td>
                  <td>
                    @if($paymentMethod->is_default)
                      <span class="badge badge-primary">default</span>
                    @endif
                    <span class="badge badge-success">Active</span>
                  </td>
                  <td style="text-align: center">
                    <a href="#" style="color:#000; "> 
                   
                    </a>
                    <div class="btn-group">
                      <i class="fa fa-ellipsis-v " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                      <div class="dropdown-menu">
                         @if($paymentMethod->is_default) 
                          <a class="dropdown-item" href="{{route('remove-default',['id'=>$paymentMethod->id])}}">Remove Default</a>
                        @else
                          <a class="dropdown-item" href="{{route('add-default',['id'=>$paymentMethod->id])}}">Add Default</a>
                        @endif
                        {{-- <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a> --}}
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('remove-method',['id'=>$paymentMethod->id])}}">Remove Method</a>
                      </div>
                    </div>
                  </td>
                </tr>
                @endforeach
                @endforeach
                @else
                <tr>
                  <td colspan="5" style="text-align: center">No data</td>
                </tr>
                @endif
            </tbody>
          </table>
        </div>
    </div>
</div>
@endsection
