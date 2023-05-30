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
                    <li class="nav-item ">
                      <a class="nav-link" href="{{route('methods')}}">Methods <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                      <a class="nav-link" href="{{route('transactions')}}">Transactions</a>
                    </li>
                    <li class="nav-item ">
                      <a class="nav-link" href="{{route('refunds')}}">Refunds</a>
                    </li>
                  </ul>
                </div>
            </nav>
        </div>
    </div>
    <br>
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
    <br>
    <div class="row mt-5">
      <div class="col-6">
        <h1>
          Transactions  List
       </h1>
      </div>
      <div class="col-6">
        <a class="btn btn-primary" style="float: right" href="{{route('transactions-create')}}">
          + Create Charge
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
          <th>Amount <small>($)</small></th>
          <th>Transaction Date</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @if(count($transactions) > 0)
          @foreach ($transactions as $transaction)
          {{-- @dd($transaction->paymentMethod) --}}
          <tr>
            <td>{{$transaction->paymentMethod->paymentgateway->gateway_name}}</td>
            <td>{{$transaction->paymentMethod->payment_method}}</td>
            <td>{{round($transaction->amount,2)}}</td>
            <td>
              <?php
               $date = new DateTime($transaction->created_at);
               $formattedDate = $date->format('d-m-Y');
                ?>
              {{$formattedDate}}
            </td>
            <td>
              @if($transaction->status=='completed')
              <span class="badge badge-success">completed</span>
              @elseif($transaction->status=='refunded')
              <span class="badge badge-primary">Refunded</span>

              @else
              <span class="badge badge-danger">Failed</span>

              @endif
            </td>
            <td style="text-align: center">
              <a href="#" style="color:#000; "> 
             
              </a>
              <div class="btn-group">
                <i class="fa fa-ellipsis-v " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
              @if($transaction->status=='completed')
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{route('create-refund',['id'=>$transaction->id])}}">Refund</a>
                </div>
              @endif
              </div>
            </td>
          </tr>
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
