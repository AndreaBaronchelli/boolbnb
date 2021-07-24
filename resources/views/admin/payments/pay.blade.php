@extends('layouts.app')

@section('content')
    <div id="dropin-container"></div>
    <button id="submit-button">Pay</button>
    <script src="http://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
    <script src="https://js.braintreegateway.com/web/dropin/1.31.0/js/dropin.min.js"></script>
    
    <script>
        let button = document.getElementById('submit-button')
        braintree.dropin
        .create({
            authorization: "sandbox_hcdxfbtn_4r7xpn58mz345fqm",
            container: document.getElementById('dropin-container'),
        }, 
        function(createErr, instance) {
            button.addEventListener('click', function(){
                instance.requestPaymentMethod(function (requestPaymentMethodErr, payload) {
                    $.get("{{ route('admin.sponsors.store', [$apartment->id, $sponsor->id]) }}", {payload}, function (response) {
                        if (response.success) {
                            alert('Payment successfull!');
                        } else {
                            alert('Payment failed');
                        }
                    }, 'json')
                    .done(function(result) {
                    instance.teardown(function (teardownErr) {
                        if (teardownErr) {
                            console.error('Could not tear down Drop-in UI!');
                        } else {
                            console.info('Drop-in UI has been torn down!');
                            $('#submit-button').remove();
                        }
                    });

                    if (result.success) {
                        $('#checkout-message').html('<h1>Success</h1><p>Your Drop-in UI is working! Check your <a href="https://sandbox.braintreegateway.com/login">sandbox Control Panel</a> for your test transactions.</p><p>Refresh to try another transaction.</p>');
                        
                    } else {
                        console.log(result);
                        $('#checkout-message').html('<h1>Error</h1><p>Check your console.</p>');
                    }
                });
            });
        });

    });
    </script>
@endsection