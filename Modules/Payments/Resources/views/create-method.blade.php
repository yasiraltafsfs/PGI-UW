@extends('payments::layouts.master')

{{-- @section('content')
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
    <div class="row"> --}}
        {{-- <div class="col-12">
          <div id="bank-account-element">
          <form action="{{route('create-method')}}" method="post" id="payment-form">
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Select Gateway</label>
                  <select class="form-control" id="gateway" required>
                    <option value="stripe">Stripe</option>
                    <option value="authorize">Authorize</option>
                  </select>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Select Method</label>
                  <select class="form-control" id="method" required>
                    <option value="cc">CC</option>
                    <option value="ach">ACH</option>
                  </select>
                </div>
              </div>
            </div>


            <div id=""></div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
          </div>
        </div> --}}
        {{-- <form action="/charge" method="post" id="payment-form" style="display: none;">
          <div class="form-row">
            <label for="card-element">
              Credit or debit card
            </label>
            <div id="card-element">
              <!-- A Stripe Element will be inserted here. -->
            </div>
        
            <!-- Used to display Element errors. -->
            <div id="card-errors" role="alert"></div>
          </div>
        
          <button>Submit Payment</button>
        </form>
    </div>
</div> --}}

<script>
  // Set your publishable key: remember to change this to your live publishable key in production
  // See your keys here: https://dashboard.stripe.com/apikeys
  // const stripe = Stripe('pk_test_51K1bH9Aq1wFAbH6DOg6TcXyIvvXaHanCwa9dZVsF1VxnBLiPBnJPxvlwCZdyfqiGzeHmzGumDDTUWPnzd5I4FJih000d9NimQh');
  // const elements = stripe.elements();
  // Custom styling can be passed to options when creating an Element.
// const style = {
// base: {
// // Add your base input styles here. For example:
// fontSize: '16px',
// color: '#32325d',
// },
// };

// Create an instance of the card Element.
// const card = elements.create('card', {style});

// // Add an instance of the card Element into the `card-element` <div>.
// card.mount('#card-element');
</script>
@endsection
