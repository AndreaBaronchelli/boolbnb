@extends('layouts.app')

@section('content')



    <script src="https://js.braintreegateway.com/web/dropin/1.31.0/js/dropin.js"></script>

    <div id="dropin-container"></div>
    <button id="submit-button" class="button button--small button--green">Purchase</button>

    {{-- <script src="{{asset('js/payment.js')}}"></script> --}}
    <script>


        var button = document.querySelector('#submit-button');

        braintree.dropin.create({
        authorization: 'sandbox_24p8f9xx_f9jw7cfqc6nt4xb5',
        selector: '#dropin-container'
        }, function (err, instance) {
            button.addEventListener('click', function () {
                instance.requestPaymentMethod(function (err, payload) {
                


                
                
                });
            })
        });
    </script>
   
@endsection


