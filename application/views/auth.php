<?php


function renderError($fieldName)
{
  $openTag = '<div class="alert alert-danger" role="alert"> ';
  $endTag = '</div>';
  if (isset($$fieldName)) {
    echo "girbura";
    echo $openTag . $$fieldName . $endTag;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title> App </title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="./public/js/app.js"   type="module"></script>
</head>

<body>

  <div class="container mt-5">
    <div class="row">
      <div class="col-md-6">
        <h2>Login</h2>
        <form method="POST" action="/auth/login">
        </form>
      </div>
    </div>
  </div>

  <script>
   
  </script>

</body>

</html>