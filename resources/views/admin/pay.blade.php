@extends('layouts.app')

@section('content')



    <script src="https://js.braintreegateway.com/web/dropin/1.31.0/js/dropin.js"></script>

    <div id="dropin-container"></div>
    <button id="submit-button" class="button button--small button--green">Purchase</button>

    {{-- <script src="{{asset('js/payment.js')}}"></script> --}}
    <script>


        var button = document.querySelector('#submit-button');

        braintree.dropin.create({
        authorization: 'sandbox_g42y39zw_348pk9cgf3bgyw2b',
        selector: '#dropin-container'
        }, function (err, instance) {
        button.addEventListener('click', function () {
            instance.requestPaymentMethod(function (err, payload) {
                


                router.post('/', (req, res, next) => {
                    const gateway = new braintree.BraintreeGateway({
                    environment: braintree.Environment.Sandbox,
                    // Use your own credentials from the sandbox Control Panel here
                    merchantId: 'f9jw7cfqc6nt4xb5',
                    publicKey: 'hmfqx93mfrfjsvw7',
                    privateKey: '737059b525db83cdcf8818d2dcaf64b0'
                });

                // Use the payment method nonce here
                const nonceFromTheClient = req.body.paymentMethodNonce;
                // Create a new transaction for $10
                const newTransaction = gateway.transaction.sale({
                    amount: '10.00',
                    paymentMethodNonce: nonceFromTheClient,
                    options: {
                        // This option requests the funds from the transaction
                        // once it has been authorized successfully
                        submitForSettlement: true
                    }
                }, (error, result) => {
                    if (result) {
                        res.send(result);
                    } else {
                        res.status(500).send(error);
                    }
                });
                });
            });
        })
        });
    </script>
   
@endsection


