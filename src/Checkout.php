<?php

namespace Razorpay\Api;

class Checkout
{
    /**
     * @param $id Order id description
     */
    public function init($orderId)

    {

      $data = [
          "order_id"          => $orderId,
          "name"              => "DJ Tiesto",
          "description"       => "Tron Legacy",
          "image"             => "https://s29.postimg.org/r6dj1g85z/daft_punk.jpg",
          "prefill"           => [
            "name"              => "Daft Punk",
            "email"             => "customer@merchant.com",
            "contact"           => "9999999999",
          ],
          "notes"             => [
            "address"           => "Hello World",
            "merchant_order_id" => "12312321",
          ],
          "theme"             => ["color" => "#F37254"],
      ];

      $json = json_encode($data);
      $this->getCheckoutHtml($json);

    }
    private function getCheckoutHtml($json) {
      $html =  '
      <button id="rzp-button1">Pay with Razorpay</button>
      <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
      <form name="razorpayform" method="POST">
          <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
          <input type="hidden" name="razorpay_signature"  id="razorpay_signature" >
      </form>
      <script>
        // Checkout details as a json
        var options = ' . $json . '
        
        /**
         * The entire list of Checkout fields is available at
         * https://docs.razorpay.com/docs/checkout-form#checkout-fields
         */
        options.handler = function (response){
            alert("The payment was successful with " + response.razorpay_payment_id)
        };
        
        // Boolean whether to show image inside a white frame. (default: true)
        options.theme.image_padding = false;
        
        options.modal = {
            ondismiss: function() {
                console.log("This code runs when the popup is closed");
            },
            // Boolean indicating whether pressing escape key 
            // should close the checkout form. (default: true)
            escape: true,
            // Boolean indicating whether clicking translucent blank
            // space outside checkout form should close the form. (default: false)
            backdropclose: false
        };
        
        var rzp = new Razorpay(options);
        
        document.getElementById("rzp-button1").onclick = function(e){
            rzp.open();
            e.preventDefault();
        }
      </script>';
      echo $html;
    }
    
}

