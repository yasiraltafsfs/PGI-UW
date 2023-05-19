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
          <div id="bank-account-element">
          <form action="{{route('add-method')}}" method="post" id="payment-form">
            @csrf
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Select Gateway</label>
                  <select class="form-control" name="gateway" id="gateway" required>
                    <option disabled selected>Select</option>
                    <option value="stripe">Stripe</option>
                  </select>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Select Method</label>
                  <select class="form-control" name="method" id="method" required>
                    <option disabled selected>Select</option>
                    <option value="cc">CC</option>
                    <option value="ach">ACH</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-12">
         
             
                  <div id="card-element"></div>
              
             
            </div>
            <br>
          </div>
          <input type="hidden" name="token" id="token" value=""/>

            <div id=""></div>
            <button type="submit"  class="btn btn-primary">Submit</button>
          </form>
          </div>
        </div> 

    </div>
</div> 

<script>
  const stripe = Stripe('pk_test_51IIYfPJdut7eHw2Mhsy6bgCiMJhk52KrZ02wXljQBJl3Shd19dZOWg2J6LPmUdgbYnVJRNqsYmYWsQBxFnGjNbei00Gbc992eQ');

  var elements = stripe.elements();
    var cardElement = elements.create('card');

    cardElement.mount('#card-element');


  var form = document.getElementById('payment-form');

  form.addEventListener('submit', function(event) {
  var gateway =   document.getElementById('gateway').value;
  var method =   document.getElementById('method').value;
  if(gateway == null || gateway == ""){
      alert('select gatway first');
  }
  if(method == null || method == ""){
      alert('select method first');
  }else{
    event.preventDefault();

stripe.createToken(cardElement).then(function(result) {
    if (result.error) {
        // Handle error
        console.error(result.error.message);
    } else {
        // Token successfully obtained
        var token = result.token;
        // You can now send the token to your server for further processing
        console.log(token.id);
        document.getElementById('token').value= token.id;
        form.submit();
    }
});
  }
      
  });
</script>
@endsection
