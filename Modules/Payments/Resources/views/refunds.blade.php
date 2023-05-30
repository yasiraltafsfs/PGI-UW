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
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('transactions')}}">Transactions</a>
                    </li>
                    <li class="nav-item active">
                      <a class="nav-link" href="{{route('refunds')}}">Refunds</a>
                    </li>
                  </ul>
                </div>
            </nav>
        </div>
    </div>
    <div class="row mt-5">
      <div class="col-12">
        <h1>
          Refunds List
        </h1>
        <table class="table table-bordered table-hover mt-2">
          <thead class="thead-dark"> 
            <tr>
              <th>Gateway Name</th>
              <th>Method <small>( CC/ACH )</small></th>
              <th>RefundID</th>
              <th>created_at</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @if(count($refunds) > 0)
              @foreach ($refunds as $refund)
              <tr>
                <td>{{$refund->paymentMethod->paymentGateway->gateway_name}}</td>
                <td>{{$refund->paymentMethod->payment_method}}</td>
                <td>{{$refund->refund_id}}</td>
                <td>
                  <!-- <span class="badge badge-primary">default</span>
                  <?php
               $date = new DateTime($refund->created_at);
               $formattedDate = $date->format('d-m-Y');
                ?>
                  <span class="badge badge-success">Active</span> -->
                  {{$formattedDate}}
                </td>
                <td>
                {{$refund->status}}
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
