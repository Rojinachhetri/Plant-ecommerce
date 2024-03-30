function kcheckout() {
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
    checkout.show({ amount: 1000 }); // Replace 1000 with your actual payment amount in paisa
}
