@extends('layouts.app')

@section('content')
<form action="{{ route('admin.sponsors.store', [$apartment->id, $sponsor->id]) }}" method="post">
    @csrf
    @method('POST')
    <div id="dropin-container"></div>
    <button id="submit-button">Pay</button>
</form>
    <script src="https://js.braintreegateway.com/web/dropin/1.31.0/js/dropin.min.js"></script>
    <script>
        let button = document.getElementById('submit-button')
        braintree.dropin
        .create({
            authorization: 'sandbox_fwz54fc9_wx43kfbnk6h5d235',
            container: document.getElementById('dropin-container'),
        }, 
        (error, dropin) => {
            if (error) {
                console.log(error);
            }
            button.addEventListener('click', function(){
                dropin.requestPaymentMethod(paymentError, payload)
                    if(paymentError) {
                        console.log(paymentError);
                    }
                    console.log(payload);
            });

        });
    </script>
@endsection