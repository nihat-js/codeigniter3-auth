



export function validateRegister({firstName,lastName,email,password,password2}){
	let errors = {

	}

	if (typeof firstName === "string"  && firstName.length<2 ){
		errors.firstName= "First Name should be at least 2 characters";
	}
	if (typeof lastName === "string" &&  lastName.length <2 ){
		errors.lastName = "Last Name should be at least 2 characters";
	}

	if (typeof email === "string" && email.length<3){
		errors.email = "Wrong email format";
	}

	if (typeof  password === "string" &&  password.length<6 ){
		errors.password = "Password is at least 6 character"
	}
	if (typeof  password2 === "string" && password2 !== password){
		errors.password2 = "Passwords doesn't match"
	}

	return errors

}

// export function validateLogin({}){

// }
