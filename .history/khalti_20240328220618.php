<body>
<?php
<script>
        document.addEventListener('DOMContentLoaded', function () {
            var config = {
                "publicKey": "your_public_key_here",
                "productIdentity": "1234567890",
                "productName": "Dragon",
                "productUrl": "http://gameofthrones.wikia.com/wiki/Dragons",
                "paymentPreference": [
                    "KHALTI",
                    "EBANKING",
                    "MOBILE_BANKING",
                    "CONNECT_IPS",
                    "SCT"
                ],
                "eventHandler": {
                    onSuccess: function (payload) {
                        console.log("Payment successful:", payload);
                    },
                    onError: function (error) {
                        console.log("Payment error:", error);
                    },
                    onClose: function () {
                        console.log("Widget closed");
                    }
                }
            };

            var checkout = new KhaltiCheckout(config);

            document.getElementById("payment-button").addEventListener("click", function () {
                checkout.show({ amount: 1000 }); // Replace 1000 with your actual payment amount in paisa (e.g., Rs. 10.00 would be 1000 paisa)
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
?>
</body>