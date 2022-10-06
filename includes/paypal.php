<?php

define("URL_SITIO", "https://xitacademy.xenturionit.com/");
require 'paypal/autoload.php';

$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        'AUYCYW51rjnow5Oi31WfcxytnnWf9LPfosojjPO4zQLezPK5iSVkofunThHT6PO1NBKmd4urOUiQES6A', //client id
        'EIR-N3pnaA4c1yL0m3zoOmPN8HyfUwF6J4gHCt8fjoN8PWkfmazyJTlPSyq8iL_VYfrqpLRaxA3VzWoo' // secret
    )
);


?>
