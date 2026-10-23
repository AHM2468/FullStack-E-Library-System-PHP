// This javaScript code is used to check the user input validation
// This method is used to check the user input in the "Registration" page
function validateSignUpForm (){
	// This string variable is used to store error messages
	var error = "";
	
	/* Now we are going to create values that are assigned to the form information by using
	the getElementById method for the "Registration" page */
	var fullname = document.getElementById("name").value;
	var email = document.getElementById("email").value;
	// pw = password, because password is a keyword in javaScript
	var pw = document.getElementById("password").value;
	var confirmPassword = document.getElementById("password2").value;
	
	// Multiple if statements to ensure that the user can't leave any information box empty
	if (fullname == ""){
		error += "- The Name is required.\n";
	}
    if (email == ""){
		error += "- The Email is required.\n";
	}
    if (pw == ""){
		error += "- The Password is required.\n";
	}
    if (confirmPassword == ""){
		error += "- The Password needs to be confirmed.\n";
	}
	if (confirmPassword != "" && pw != "" && confirmPassword != pw) {
		error += "- The Password was not confirmed correctly.\n";
	}
	// Simple check to make sure the email is valid
    if (email != "" && (email.indexOf("@") == -1 || email.indexOf(".") == -1)) {
        error += "- Please enter a valid Email address.\n";
    }
	// This if statement is used in case the user did not enter a password with the required length
    if (pw != "" && pw.length < 8) {
        error += "- The Password must be at least 8 characters.\n";
    }
	// This nested if statement is used to check if the password contains both uppercase and lowercase letters
	if (pw != ""){
        if (pw == pw.toLowerCase()){
            error += "- The Password must contain at least one uppercase letter.\n";
        }
        if (pw == pw.toUpperCase()){
            error += "- The Password must contain at least one lowercase letter.\n";
        }
    }
	// This if-else statement displays the popup box that shows the errors in case there were errors
    if (error != ""){
		alert("These errors must be checked and solved:\n" + error);
		// This will prevent the user from writing wrong inputs
        return false;
	} else {
		return true;
	}
}
// This method is used to check the user input in the "Login" page
function validateLoginForm() {
    var error = "";
    var email = document.getElementById("email").value;
    var pw = document.getElementById("password").value;
    if (email == "") {
        error += "- The Email is required.\n";
    }
    if (pw == "") {
        error += "- The Password is required.\n";
    }
    if (error != "") {
        alert("These errors must be checked and solved:\n" + error);
        return false;
    } else {
        return true;
    }
}