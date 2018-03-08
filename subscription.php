<?php

require('Stripe.php');

$stripe = new Stripe ('');//secret key

$stripe->api('customers/cus_CEORSTRzDkzJ50'//custumerID, [

	'plan' => 'premium',

]);