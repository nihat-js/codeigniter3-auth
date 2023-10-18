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
  <title>Login and Register System</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
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

  <script >
    let formType = "LOGIN";
    let fields = {
      firstName: renderField("firstName", "First Name", "text", "Enter your first name"),
      lastName: renderField("lastName", "Last Name", "text", "Enter your last name"),
      email: renderField("email", "Email", "email", "Enter your email"),
      password : renderField("password", "Password", "password", "Enter your password"),
      password2 : renderField("password", "Re-type Password", "password", "Re-type  password"),
      button : renderButton(),
    }

    function swithForm() {
      formType = formType == "LOGIN" ? "REGISTER" : "LOGIN"
      renderForm()
    }

    function renderField(inputName, labelText, inputType = "text", placeholder) {
      if (!placeholder) placeholder = "Enter your " + labelText.toLowerCase();
      let div = document.createElement('div')
      let label = document.createElement('label')
      let input = document.createElement('input')
      div.className = "form-group"
      label.innerText = labelText
      input.type = inputType
      input.name = inputName
      input.placeholder = placeholder
      input.classList = "form-control"
      div.append(label, input)
      return div
      // <div class="form-group">
      //       <label for="registerPassword">Password</label>
      //       <input type="password" class="form-control" name="password" id="registerPassword" placeholder="Password">
      //     </div>
    }

    //dynamic
    function renderSwitcher(){
      let div = document.createElement("div")
      let p = document.createElement("p")
      let a = document.createElement("a")
      if (formType == "LOGIN"){
        p.innerText = "Don't you have an account?"
        a.innerText = "Register"
      }else if (formType == "REGISTER") {
        p.innerText = "You have an account ?"
        a.innerText = "Login" 
      }
      a.onclick = swithForm
      p.append(a)
      div.append(p)
      return div
    }

    function renderButton() {
      let btn = document.createElement('button')
      btn.type = "submit"
      btn.className = "btn btn-primary";
      btn.innerText = formType.toLowerCase()
      return btn
      // <button type="submit" class="btn btn-primary">Register</button>      
    }
  
    function renderForm() {
      let form = document.querySelector("form")
      form.innerHTML = ""
      if (formType == "LOGIN") {
        form.append(fields.email,fields.password,renderSwitcher(),renderButton())
      } else if (formType == "REGISTER") {
        form.append(fields.firstName,fields.lastName,fields.email,fields.password,renderSwitcher(), renderButton())
      }

    }

    renderForm()

    function handleClick() {
      fetch("/auth/login", () => {

      })
    }
  </script>

</body>

</html>