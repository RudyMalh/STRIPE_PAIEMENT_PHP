<?php

http_response_code(200);


require('Stripe.php');

$stripe = new Stripe ('');//secret key

$input = file_get_contents('php://input');

$event = json_decode($input);

$event = $stripe->api('events/{$event->id}');

var_dump($event);

//traitement PHP par rapport à l'évènement