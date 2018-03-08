<!DOCTYPE html>
<html>
<head>
	<title>STRIPE</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<form action="payment.php" id="payment_form" method="post">
		  <div class="form-group">
		    <label for="pwd">Name:</label>
		    <input type="text" class="form-control" name="name" placeholder="Votre nom" value="Rudy" required>
		  </div>
		  <div class="form-group">
		    <label for="email">Email address:</label>
		    <input type="email" class="form-control" name="email" placeholder="votre@email.fr" value="rudy.malh@gmail.com" required>
		  </div>
		  <div class="form-group">
		    <label for="carte">Code de carte:</label>
		    <input type="text" class="form-control" name="carte" placeholder="Votre code de carte bleu" data-stripe="number" value="4242 4242 4242 4242">
		  </div>
		  <div class="form-group">
		    <label for="carte">Date d'expriation:</label>
		    <input type="text" class="form-control" name="month" placeholder="MM" data-stripe="exp-month" value="10">
		    <input type="text" class="form-control" name="year" placeholder="YY" data-stripe="exp-year" value="18">
		  </div>
		  <div class="form-group">
		    <label for="carte">CVC:</label>
		    <input type="text" class="form-control" name="cvc" placeholder="CVC" data-stripe="cvc" value="123">
		  </div>
		  <div class="checkbox">
		    <label><input type="checkbox">Se rappeler de moi</label>
		  </div>
		  <button type="submit" class="btn btn-default">Acheter</button>
		</form>
	</div>
	<script src="https://js.stripe.com/v2/"></script>
	<script src="https://js.stripe.com/v3/"></script>
	<script>

		Stripe.setPublishableKey('');//public key

		var $form = $('#payment_form')

		$form.submit(function (e) {

			e.preventDefault();

			$form.find('.button').attr('disable', true);

			Stripe.card.createToken($form, function(status, response) {

				if(response.error) {

					$form.find('.message').remove();

					$form.prepend('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><p>' + response.error.message + '</p></div>');

				}else {

					var token = response.id;

					$form.append($('<input type="hidden" name="stripeToken">').val(token));

					$form.get(0).submit();

				}

			});

		});
	</script>
</body>
</html>