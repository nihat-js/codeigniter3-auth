import { appendInputToForm } from "./utils/appedInputToForm.js"

let formType = "LOGIN"
let [firstNameEl, firstNameErr] = appendInputToForm("firstName", "First Name", "text", "Enter your first name")
let [lastNameEl, lastNameErr] = appendInputToForm("lastName", "Last Name", "text", "Enter your last name")
let [emailEl, emailErr] = appendInputToForm("email", "Email", "email", "Enter your email")
let [passwordEl, passwordErr] = appendInputToForm("password", "Password", "password", "Enter your password")
let [password2El, password2Err] = appendInputToForm("password2", "Re-type Password", "password", "Re-type  password")
renderToggler()


function toggleForm() {
  let formParent = document.querySelector("form")
  let registerArr = [firstNameEl, lastNameEl, password2El];
  for (let el of registerArr) {
    el.style.display = formType == "LOGIN" ? "none" : "block"
  }
}







function renderToggler() {

  if (!document.querySelector("form .toggler")) {
    let div = document.createElement("div")
    let p = document.createElement("p")
    let a = document.createElement("a")
    div.classList = "toggler"
    p.append(a)
    a.onclick = toggleForm
    div.append(p)
    document.querySelector("form").append(div)
  }

  let p = document.querySelector("form .toggler p")
  let a = document.querySelector("form .toggler a")

  if (formType == "LOGIN") {
    p.innerText = "Don't you have an account?"
    a.innerText = "Register"
    a.href = "/auth/register"
  } else if (formType == "REGISTER") {
    p.innerText = "You have an account ?"
    a.innerText = "Login"
    a.href="/auth/login"
  }
}

function validateWhenTyping() {
  if (firstNameEl != "" && firstNameEl.length < 2) {
    firstNameErr.innerText = "Firstname shouldn't be less than 2 character"
  }
  if (form.lastName != "" && form.lastName.length < 2) {
    lastNameErr.innerText = "Lastname shouldn't be less than 2 character"
  }
}

function renderButton() {
  let btn = document.createElement('button')
  btn.type = "submit"
  btn.className = "btn btn-primary";
  btn.innerText = form.type.toLowerCase()
  btn.onclick = handleButton
  return btn
  // <button type="submit" class="btn btn-primary">Register</button>      
}


function handleButton(e) {
  e.preventDefault()
  if (form.type == "LOGIN") {
    login()
  } else if (form.type == "REGISTER") {
    register()
  }
}

function register() {
  let hasError = false
  let { firstName, lastName, email, password, password2 } = form
  if (firstName.value.length < 2 || lastName.value.length < 2) {
    form.firstName.err = "Check your first name and surname."
    hasError = true
  }
  if (password.value.length < 6) {
    form.password.err = "Password should be min 6 characters";
    hasError = true
  }
  if (password2.value != password.value) {
    form.password2.err = "Passwords are not matched"
    hasError = true
  }

  if (hasError) {
    renderUI();
    return false
  }



}
function login() {

}

toggleForm()