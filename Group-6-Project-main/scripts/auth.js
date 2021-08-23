//variables for login forms
const signup = document.getElementById("signup");
const signin = document.getElementById("signin");
const resetForm = document.getElementById("reset");

//variables for logged in and logged out display
const loggedOutContent = document.querySelectorAll('.logged-out');
const loggedInContent = document.querySelectorAll('.logged-in');

//variables for error message display
const alerts = document.querySelectorAll('.alert');
const errorLgin = document.getElementById("badLogin");
const errorSgnup = document.getElementById("badSignup");
const resetMsg = document.getElementById("pwdReset");




//enters register form input to database and signs user into Firebase Auth
signup.addEventListener('submit', (e) => {
   e.preventDefault();

    //input validation
  var id = "signup";
  if(validateInput(id)){

  	//Firebase Auth
	firebase.auth().createUserWithEmailAndPassword(signup["email"].value, signup["password"].value)
		.then((userCredential) => {

		// Signed in
		var user = userCredential.user;

		//Firestore Database add new user info
		addUser(user);

	  })
	  .then(() => {
		$('#registerModal').modal("hide");
		signup.reset();
	  })
	  .catch((error) => {
		// show error message
		var string = `
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		${error.message}
		`;
		errorSgnup.style.display='block';
		errorSgnup.innerHTML = string;
	  });
  } else {
	  var string = `
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		<p style='display:inline'>Passwords do not match.</p>
		`;
		// show error message for passwords not matching
		errorSgnup.style.display='block';
		errorSgnup.innerHTML = string;
  }
});


//signs user into Firebase Auth
signin.addEventListener('submit', (e) => {
  e.preventDefault();

  //input validation
  var id = "signin";

  	//Firebase Auth
	firebase.auth().signInWithEmailAndPassword(signin.elements["email"].value, signin.elements["password"].value)
		.then((userCredential) => {

		//reset form
		signin.reset();

	  })
	  .catch((error) => {
		console.log(error.code);
		//get error code
		if (error.code ==="auth/user-not-found") {
			var string = `
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		${error.message}
		<p style='display:inline'>Create an account by clicking the Register button</p>
		`;
		} else if (error.code ==="auth/wrong-password") {
			var string = `
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		${error.message}
		<button style='display:inline' data-toggle="modal" data-target="#resetModal">Forgot password?</button>
		`;
		} else {
			var string = `
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		${error.message}
		<p style='display:inline' >Not sure what the heck you're trying to do, but it's not working</p>
		`;
		}

		// show error message
		errorLgin.style.display='block';
		errorLgin.innerHTML = string;
	  });

});


//logout
function logout(){
	firebase.auth().signOut().then(() => {

	}).catch((error) => {
	  // An error happened.
	});
}

//reset password via email
resetForm.addEventListener('submit', (e) => {
  e.preventDefault();

	errorLgin.style.display='none';
	
	var email = resetForm["emailReset"].value;
	firebase.auth().sendPasswordResetEmail(email).then(function() {
	  // Email sent.
		resetMsg.style.display='block';
		resetMsg.innerHTML = `
		<a href'#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		An email has been sent to your inbox. Please click the link in the email to reset your password.
		`;
	}).then(() => {
		$('#resetModal').modal("hide");
		resetForm.reset();
	  }).catch(function(error) {
		resetMsg.style.display='block';
		resetMsg.innerHTML = `
		<a href'#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		${error.message}
		`;
	});
});


//data validation
function validateInput(id){
  var form = document.getElementById(id);
	  if (form["password"].value !== form["confPwd"].value) {
		return false;
	} else {
		return true;
	}
}


//Firestore Database add new user info
function addUser(user){
	return firebase.firestore().collection('users').doc(user.uid).set({
		firstName: signup["firstName"].value,
		lastName: signup["lastName"].value,
		phone: signup["phone"].value,
		school: signup["school"].value,
		gradDate: signup["gradDate"].value,
		premium: false
	});
}