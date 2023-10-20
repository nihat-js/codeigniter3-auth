<?php


function renderError($msg)
{
	$openTag = '<div class="alert alert-danger" role="alert"> ';
	$endTag = '</div>';
	echo $openTag . $msg . $endTag;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title> App </title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.5.1/axios.min.js"></script>
</head>

<body>

<div class="container mt-5">
	<div class="row">
		<div class="col-md-6">
			<h2>Login</h2>
			<form method="POST" action="/auth/login">
			</form>
			<?php isset($register_error) ? renderError($register_error) : "" ?>
			<?php isset($login_error) ? renderError($login_error) : "" ?>
		</div>
	</div>
</div>

<script>
	let isLoginLayout =  <?php
	if (!isset($register_error) && !isset($login_error)) {
		echo 'true;';
	} else if ($login_error) {
		echo 'true;';
	} else if ($login_error) {
		echo 'false;';
	}
	?>
	console.log(isLoginLayout);
</script>
<script src="/public/js/app.js" type="module"></script>

</body>

</html>
