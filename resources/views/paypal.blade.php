<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <title>PaymentAmount</title>
</head>
<body>
    <div id="paypal-payment-button"></div>

    <script src="https://www.paypal.com/sdk/js?client-id=AR7Vf-XUMn_oyA8oi5gBDnhDs_KCdG0p9MeqvmLlM4-7QJhT8eaKSsHmiqmFJruXv21NboNhicAvehET&currency=HKD&disable-funding=credit,card"></script>

    <script>
    paypal.Buttons({
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '10'
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                console.log(details)
            })
        }
    }).render('#paypal-payment-button');
</script>

</body>
</html>