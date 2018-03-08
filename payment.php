<?php 

$token = $_POST['stripeToken'];

$email = $_POST['email'];

$name = $_POST['name'];

/*$exp_month = $_POST['month'];

$exp_year = $_POST['year'];*/

if(filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($name) && !empty($token)) {

	require('Stripe.php');

	$stripe = new Stripe ('');//secret key
	
	$customer = $stripe->api('customers', [

		'source' => $token,

		'description' => $name,

		'email' => $email

	]);

	$charge = $stripe->api('charges', [

		'amount' => 1000,

		'currency' => 'eur', 

		'customer' => $customer->id

	]);

	var_dump($charge);

	die('Bravo votre paiement à bien été enregistré !');



	/*$ch = curl_init();

	$data = [

		'source' => $token,

		'description' => $name,

		'email' => $email

	];

	curl_setopt_array($ch, [

		CURLOPT_URL => 'https://api.stripe.com/v1/customers',

		CURLOPT_RETURNTRANSFER => true,

		CURLOPT_USERPWD => 'sk_test_JWjv6lYEh98eV6ffgmyh0nTe',

		CURLOPT_HTTPAUTH => CURLAUTH_BASIC,

		CURLOPT_POSTFIELDS => http_build_query($data)

	]);

	$customer = json_decode(curl_exec($ch));

	curl_close($ch);

	die();*/

}



/* 

curl https://api.stripe.com/v1/charges \
   -u sk_test_JWjv6lYEh98eV6ffgmyh0nTe: \
   -d amount=2000 \
   -d currency=eur \
   -d source=tok_mastercard \
   -d description="Charge for aubrey.jones@example.com"

*/