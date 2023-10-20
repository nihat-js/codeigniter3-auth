import {appendButton, appendInput, appendToggle, renderButton, renderToggle} from "./utils/formActivities.js"

// let isLoginLayout = false


appendInput("firstName", "First Name", "text", "Enter your first name")
appendInput("lastName", "Last Name", "text", "Enter your last name")
appendInput("email", "Email", "email", "Enter your email")
appendInput("password", "Password", "password", "Enter your password")
appendInput("password2", "Re-type Password", "password", "Re-type  password")
appendInput("birthday", "Your birthday (optional) ", "date")
appendToggle()
appendButton()


let {firstName, lastName, email, password, password2, birthday} = document.forms[0]


firstName.onkeydown = debounceInput((e) => {
	return [e.target.value.length < 2, "It should be at least 2 characters"]
})

lastName.onkeydown = debounceInput((e) => {
	return [e.target.value.length < 2, "It should be at least 2 characters"]
})

email.onkeydown = debounceInput((e) => {
	return [e.target.value.length === 0, "Email is required "]
})


password.onkeydown = debounceInput((e) => {
	return [e.target.value.length < 6, "Password is required and should be at least 6 characters"]
})

password2.onkeydown = debounceInput((e) => {
	return [e.target.value !== password.value, "Passwords don't match"]
})

document.querySelector("form .toggle a").onclick = () => toggleForm()

document.querySelector("form button").onclick = (e) => {
	e.preventDefault();
	//validate
	// isLoginLayout?  login() : register()
	document.forms[0].submit();
}



function toggleForm(isInitial) {
	if (!isInitial)  isLoginLayout = !isLoginLayout
	let formParent = document.querySelector("form")
	let registerArr = [firstName, lastName, password2, birthday];
	for (let el of registerArr) {
		isLoginLayout ? el.parentNode.classList.add("d-none") : el.parentNode.classList.remove("d-none")
	}
	document.forms[0].action = isLoginLayout ?  "/auth/login" : "/auth/register"
	renderButton(isLoginLayout)
	renderToggle(isLoginLayout)
}

function debounceInput(cb) {
	let id
	let hasTouched = false
	return function (...args) {

		if (id) {
			clearInterval(id)
		}
		id = setTimeout(() => {
			let target = args[0].target
			let errEl = target.nextSibling;
			let [hasError, errorMessage] = cb(...args)
			if (hasError) {
				errEl.innerText = errorMessage
				errEl.classList.remove("d-none")
			} else {
				errEl.classList.add('d-none')
			}
			// cb(...args)
		}, 400)
	}
}




async function register() {
	// let hasError = false
	// if (firstName.value.length < 2 || lastName.value.length < 2) {
	// 	form.firstName.err = "Check your first name and surname."
	// 	hasError = true
	// }
	// if (password.value.length < 6) {
	// 	passwordErr.err = "Password should be min 6 characters";
	// 	hasError = true
	// }
	// if (password2.value != password.value) {
	// 	form.password2.err = "Passwords are not matched"
	// 	hasError = true
	// }
	//
	// if (hasError) {
	// 	return false
	// }

}

toggleForm(true)

