<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
</head>

<body>
    <section class="payment_wrapper">
        <div class="container my-4">
            <div class="row my-4 py-4 mx-auto">
                <div class="col-lg-12 mx-auto"><button id="payment-button" class="fs-2 text-light border-0 
                    px-2 rounded-pill bg-danger">Pay with Khalti</button>
                </div>

            </div>

        </div>

    </section>
    <!-- Place this where you need payment button -->

    <!-- Place this where you need payment button -->
    <!-- Paste this code anywhere in you body tag -->
    <script>
        var config = {
                // replace the publicKey with yours
                "publicKey": "test_public_key_dc74e0fd57cb46cd93832aee0a390234",
                "productIdentity": "1234567890",
                "productName": "Dragon",
                "productUrl": "http://gameofthrones.wikia.com/wiki/Dragons",
                "paymentPreference": [
                    "KHALTI",
                    "EBANKING",
                    "MOBILE_BANKING",
                    "CONNECT_IPS",
                    "SCT",
                ],
                "eventHandler": {
                    onSuccess(payload) {
                        // hit merchant api for initiating verfication
                        console.log(payload);
                    },
                    onError(error) {
                        console.log(error);
                    },
                    onClose() {
                        console.log('widget is closing');
                    }
                } 
            }
            </script>
                </body> 
                </html>