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
</div>
@endsection
