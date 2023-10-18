<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login and Register System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
  <?php
  echo $message;
  ?>
    <div class="row">
        <div class="col-md-6">
            <h2>Login</h2>
            <form method="POST" action="/auth/login">
                <div class="form-group">
                    <label for="loginEmail">Email</label>
                    <input type="email" name="email" class="form-control" id="loginEmail" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="loginPassword">Password</label>
                    <input type="password"  name="password" class="form-control" id="loginPassword" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
        <div class="col-md-6">
            <h2>Register</h2>
            <form method="POST" action="/auth/register">
                <div class="form-group">
                    <label for="registerName">Name</label>
                    <input type="text" class="form-control" name="username" id="registerName" placeholder="Enter your username">
                </div>
                <div class="form-group">
                    <label for="registerEmail">Email</label>
                    <input type="email" class="form-control" name="email" id="registerEmail" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="registerPassword">Password</label>
                    <input type="password" class="form-control" name="password"  id="registerPassword" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
