<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo</title>
</head>
<body>
<button id = "rzp-button1">Pay</button>
<script src = "https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
  var options = {
    "key": "key_id", // api-key
    "subscription_id": "sub_00000000000001",
    "name": "Acme Corp.",
    "description": "Monthly Test Plan",
    "image": "/your_logo.png",
    "handler": function(response) {  // Manual checkout with handler function
      alert(response.razorpay_payment_id),
      alert(response.razorpay_subscription_id),
      alert(response.razorpay_signature);
    },
   // "callback_url": "https://eneqd3r9zrjok.x.pipedream.net/",  // Manual checkout with Callback Url
    "prefill": {
      "name": "Gaurav Kumar",
      "email": "gaurav.kumar@example.com",
      "contact": "+919876543210"
    },
    "notes": {
      "note_key_1": "Tea. Earl Grey. Hot",
      "note_key_2": "Make it so."
    },
    "theme": {
      "color": "#F37254"
    }
  };
var rzp1 = new Razorpay(options);
document.getElementById('rzp-button1').onclick = function(e) {
  rzp1.open();
  e.preventDefault();
}
</script>
</body>
</html>
