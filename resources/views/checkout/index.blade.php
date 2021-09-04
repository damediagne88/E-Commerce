@extends('layouts.master')

@section('extra_meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('extra_script')
<script src="https://js.stripe.com/v3/"></script>
@endsection



@section('content')


        <div class="col-md-12">
          <h2> Page de paiement</h2>
          <div class="row">

          <div class="col-md-6">

          <form action="{{ route('checkout.store')}}" method="post" id="payment-form" class="my-4">
            @csrf
            <div id="card-element">
              <!-- Elements will create input elements here -->
            </div>

            <!-- We'll put the error messages in this element -->
            <div id="card-errors" role="alert"></div>

            <button class="btn btn-success mt-4" id="submit">Proceder au paiement ({{ getPrice(Cart::total()) }})</button>
          </form>
          </div>

          </div>
        </div>


@endsection

@section('extra_footer')
<script>

var stripe = Stripe('pk_test_oKhSR5nslBRnBZpjO6KuzZeX');
var elements = stripe.elements();

// pour le style
var elements = stripe.elements();
var style = {
  base: {
    color: "#32325d",
  }
};

// pour gerer les erreurs 
var card = elements.create("card", { style: style });
card.mount("#card-element");

card.on('change', ({error}) => {
  let displayError = document.getElementById('card-errors');
  if (error) {
    displayError.textContent = error.message;
  } else {
    displayError.textContent = '';
  }
});

// soumission
var form = document.getElementById('payment-form');

form.addEventListener('submit', function(ev) {
  ev.preventDefault();
 
  // If the client secret was rendered server-side as a data-secret attribute
  // on the <form> element, you can retrieve it here by calling `form.dataset.secret`
  stripe.confirmCardPayment("{{ $clientSecret }}", {
    payment_method: {
      card: card
    }
  }).then(function(result) {
    if (result.error) {
     
      // Show error to your customer (e.g., insufficient funds)
      console.log(result.error.message);
    } else {
      // The payment has been processed!
      if (result.paymentIntent.status === 'succeeded') {
        /**
         * Définir les variable dont on aura besion 
         */

        var paymentIntent = result.paymentIntent;
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var form = document.getElementById('payment-form');
        var url =form.action;
        var redirect = '/merci';

        fetch(
              
          url,
          {
            headers:{
                "Content-Type": "application/json",
                "Accept" : "application/json, text-plain, */*",
                "X-Requested-With" : "XMLHttpRequest",
                "X-CSRF-TOKEN" : token

            },
            method: 'post',
            body : JSON.stringify({
              paymentIntent: paymentIntent
            })

            
          }

        ).then((data) => {
           console.log(data)
           window.location.href = redirect;
        }).catch((error) => {
          console.log(error)
        })
      }
    }
  });
});

</script>
@endsection