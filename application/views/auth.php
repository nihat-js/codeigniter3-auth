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

  <script>
    let form = {
      type: "LOGIN",
      firstName: {
        value: "",
        element: generateInputGroup("firstName", "First Name", "text", "Enter your first name"),
      },
      lastName: {
        value: "",
        element: generateInputGroup("lastName", "Last Name", "text", "Enter your last name"),
      },
      email: {
        value: "",
        element: generateInputGroup("email", "Email", "email", "Enter your email"),
      },
      password: {
        value: "",
        element: generateInputGroup("password", "Password", "password", "Enter your password"),
      },
      password2: {
        value: "",
        element: generateInputGroup("password", "Re-type Password", "password", "Re-type  password"),
      },
     
      init: function() {
        console.log("65")
        document.querySelector("form").append(
          this.firstName.element, this.lastName.element, this.email.element, this.password.element, this.password2.element,renderSwitcher(), this.button.render()
        )
      },
      render: function() {
        let arr = [this.firstName.element, this.lastName.element, this.email.element, this.password, this.password2]
        for (let el of arr) {
          el.style.display = this.type == "REGISTER" ? "block" : "none"
        }
      },
      switch: function() {
        this.type = this.type == "LOGIN" ? "REGISTER" : "LOGIN"
        this.render();
      }

    }


    function generateInputGroup(inputName, labelText, inputType = "text", placeholder) {
      if (!placeholder) placeholder = "Enter your " + labelText.toLowerCase();
      let div = document.createElement('div')
      let label = document.createElement('label')
      let input = document.createElement('input')
      div.className = "form-group"
      label.innerText = labelText
      input.type = inputType
      input.name = inputName
      input.placeholder = placeholder
      input.onchange = function(e) {
        console.log("i changed")
        fields[name].value = document.forms[0].inputName.value
      }
      input.classList = "form-control"
      div.append(label, input)
      return div
      // <div class="form-group">
      //       <label for="registerPassword">Password</label>
      //       <input type="password" class="form-control" name="password" id="registerPassword" placeholder="Password">
      //     </div>
    }

    //dynamic



    function renderSwitcher() {
      let div = document.createElement("div")
      let p = document.createElement("p")
      let a = document.createElement("a")
      if (form.type == "LOGIN") {
        p.innerText = "Don't you have an account?"
        a.innerText = "Register"
      } else if (form.type == "REGISTER") {
        p.innerText = "You have an account ?"
        a.innerText = "Login"
      }
      a.onclick = swithForm
      p.append(a)
      div.append(p)
      return div
    }

    function validateWhenTyping() {

    }

    function renderButton() {
      let btn = document.createElement('button')
      btn.type = "submit"
      btn.className = "btn btn-primary";
      btn.innerText = form.type.toLowerCase()
      return btn
      // <button type="submit" class="btn btn-primary">Register</button>      
    }
    

    function handleClick() {


      fetch("/auth/login", () => {

      })
    }

    form.init()
  </script>

</body>

</html>