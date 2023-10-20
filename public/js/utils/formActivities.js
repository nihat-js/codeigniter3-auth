export function appendInput(inputName, labelText, inputType = "text", placeholder,) {
  if (!placeholder) placeholder = "Enter your " + labelText.toLowerCase();
  let div = document.createElement('div')
  let label = document.createElement('label')
  let input = document.createElement('input')
  div.className = "form-group " + inputName
  label.innerText = labelText
  input.type = inputType
  input.name = inputName
  input.placeholder = placeholder

  input.classList = "form-control"
  let errorDiv = document.createElement("div")
  errorDiv.classList = "mt-2 alert alert-danger d-none"
  div.append(label, input, errorDiv)
  document.querySelector("form").append(div)
  return [div, errorDiv]
}

export function appendButton(){
	let btn = document.createElement('button')
	btn.type = "submit"
	btn.className = "btn btn-primary my-3";
	document.querySelector("form").append(btn)
  
}



export function appendToggle(){
	let div = document.createElement("div")
	let p = document.createElement("p")
	let a = document.createElement("a")
	div.classList = "toggle"
	a.href = "#"
  a.style.display = "inline-block"
  p.style.display = "inline-block"
  p.classList.add('mr-2')
	div.append(p, a)
	document.querySelector("form").append(div)
}

export function renderToggle(isLoginLayout) {

	let p = document.querySelector("form .toggle p")
	let a = document.querySelector("form .toggle a")
	//
	if (isLoginLayout) {
		p.innerText = "Don't you have an account?"
		a.innerText = "Register"
	} else {
		p.innerText = "You have an account ?"
		a.innerText = "Login"
	}
}

export  function renderButton(isLoginLayout) {
	document.querySelector("form button").innerText = isLoginLayout ? "Login" : "Register"
}

