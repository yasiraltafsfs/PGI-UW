@extends('payments::layouts.master')

 @section('content')
 <style>
  #card-element {
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
  }
  fieldset{
    padding: 10px;
    border: 1px solid red
  }
</style>
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
    <div class="row mt-5">

    </div>
    <div class="row"> 
        <div class="col-12">
            <h1>Create Charge</h1>
            @if(!empty($is_default))
          <form action="{{route('create-charge')}}" method="post" id="payment-form" style="padding:20px;background-color:antiquewhite">
            @csrf
            <div class="row">
              <!-- <div class="col-6">
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Select Gateway</label>
                  <select class="form-control" name="gateway" id="gateway" required>
                    <option disabled selected>Select</option>
                    <option value="stripe">Stripe</option>
                    <option value="authorize">Authorize</option>
                  </select>
                </div>
              </div> -->
              <div class="col-6">
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Enter You Amount($)</label>
                    <input class="form-control" type="number" name="amount" required placeholder="enter amount to charge" />
                </div>
              </div>
              <div class="col-12">
                <button  type="submit"  class="btn btn-success">Charge Now</button>
              </div>

            </div>

          </form>
          @else
                <a class="btn btn-lg btn-primary" href="{{route('methods')}}"> Add Default Method First</a>
          @endif
        </div> 

    </div>
</div> 

@endsection
