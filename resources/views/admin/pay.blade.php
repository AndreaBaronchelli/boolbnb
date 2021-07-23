@extends('layouts.app')

@section('content')

    {{-- Primo tentativo --}}
    {{-- <script src="https://js.braintreegateway.com/web/dropin/1.31.0/js/dropin.js"></script>

    <div id="dropin-container"></div>
    <button id="submit-button" class="button button--small button--green">Purchase</button> --}}

    {{-- <script src="{{asset('js/payment.js')}}"></script> --}}





    {{-- Secondo tentativo --}}
    {{-- interazione tra l'SDK JavaScript lato client e il codice lato server --}}
    {{-- <script src="https://js.braintreegateway.com/web/dropin/1.22.1/js/dropin.min.js"></script> --}}

    {{-- token generato nella view come variabile JavaScript --}}
    {{-- <script>
        var clientToken = '<%= clientToken %>';
    </script> --}}

    {{-- script --}}
    {{-- <div id="dropin-container"></div>

    <form id="dropin" class="form-inline" method="post" action="">
        <div>
            <input type="text" name="amount" id="amount" class="form-control" placeholder="Amount">
            <button id="request" type="button" class="btn btn-primary">Pay Now</button>
        </div>
        
    </form>   --}}
    

    <script>
       
        
        
        
        
        /*
        Primo tentativo
        
        
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
        */

        /*Secondo tentativo*/
       //credenziali di riferimento
       /*
        module.exports = {
            merchantId: 'sff9x6cz2smm8qhq',
            publicKey: '2j858dh2vbr7mvwk',
            privateKey: '385844387a1ede007c0dfcd0a525191e'
        };
            
        //generazione di un token
        const express = require('express');
        const router = express.Router();
        const braintree = require('braintree');
        const { merchantId, publicKey, privateKey } = require('../config');
        const gateway = braintree.connect({
            environment: braintree.Environment.Sandbox,
            merchantId,
            publicKey,
            privateKey
        });

        router.get('/', (req, res, next) => {
            gateway.clientToken.generate({}, (err, response) => {
                const { clientToken } = response;
                res.render('index', { clientToken } );
            });    
        });

        //elaborazione del pagamento
        router.post('/checkout', (req, res, next) => {

            const nonceFromTheClient = req.body.payment_method_nonce;
            const amount = req.body.amount;

            gateway.transaction.sale({
                amount: amount,
                paymentMethodNonce: nonceFromTheClient,
                options: {
                submitForSettlement: true
                }
            }, (err, result) => {
                res.send( { status: result.success  } )
            });
        });

        module.exports = router;

        // nonce in una richiesta AJAX alla route che gestisce la transazione passando anche l'importo da pagare.
        $(function() {
            if( clientToken ) {
                var $button = $( "#request" );

                braintree.dropin.create({
                    authorization: clientToken,
                    container: "#dropin-container"
                }, function ( createErr, instance ) {
                    $button.on( "click", function () {
                    
                    var amount = $( "#amount" ).val();
                    var amt = $.trim( amount ).replace( ",", "." );

                    if( !isNaN( Number( amt ) ) ) {
                        instance.requestPaymentMethod(function ( err, payload ) {
                            $.post( "/checkout", { payment_method_nonce: payload.nonce, amount: amt }, function( res ) {
                                // res.status deve essere true
                            });
                        });
                    }
                    });
                });
            }
        });
        */

        
        //Terzo Tentativo
        
        

    </script>
   
@endsection


