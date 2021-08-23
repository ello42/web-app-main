//check if user is logged in
firebase.auth().onAuthStateChanged(function(user) {
	if (user) {

		// toggle user UI elements
		loggedInContent.forEach(item => item.style.display = 'block');
		loggedOutContent.forEach(item => item.style.display = 'none');
		alerts.forEach(item => item.style.display = 'none');

		firebase.firestore().collection('users').doc(user.uid).onSnapshot((doc) => {

		  //display logged in user in upper right hand corner and user information on profile page
		  var userName = document.getElementById("userInfo");
		  var profile = document.getElementById("profile");
		  var string = `
			<strong>User info:</strong><br><br>
			First Name: ${doc.data().firstName}<br><br>
			Last Name: ${doc.data().lastName}<br><br>
			Email Address: ${user.email}<br><br>
			Phone Number: ${doc.data().phone}<br><br>
			School: ${doc.data().school}<br><br>
			Graduation Date: ${doc.data().gradDate}<br><br>
			Premium Account: ${doc.data().premium}<br><br>
			<button class="btn btn-default" data-toggle="modal" data-target="#editModal">Edit</button>
			<button class="btn btn-default" data-toggle="modal" data-target="#pwdModal">Change Password</button>
		  `;
		  userInfo.innerHTML = doc.data().firstName + " " + doc.data().lastName;
		  profile.innerHTML = string;

		 });
	} else {

	  // toggle user UI elements
		loggedInContent.forEach(item => item.style.display = 'none');
		loggedOutContent.forEach(item => item.style.display = 'block');

	  profile.innerHTML = 'Log in to view profile';
	}
});

const editUser = document.getElementById("editUser");

//changes user profile info
editUser.addEventListener('submit', (e) => {
  e.preventDefault();

	var user = firebase.auth().currentUser;
	console.log(user.uid);

	// change info in Firestore database
	firebase.firestore().collection("users").doc(user.uid).update({
		firstName: editUser["firstName"].value,
		lastName: editUser["lastName"].value,
		phone: editUser["phone"].value,
		school: editUser["school"].value,
		gradDate: editUser["gradDate"].value
	})
	.then(() => {
		//change info in Auth
		user.updateProfile({
		  email: editUser["email"].value
		}).then(function() {
		  // Update successful.
		}).catch(function(error) {
		  // An error happened.
		});
	})
	.then(() => {
		//close modal
		$('#editModal').modal("hide");
		editUser.reset();

		//display success message
		var message = document.getElementById("editMsg");
		message.style.display='block';
		message.innerHTML = `
		<div class="alert alert-dismissible alert-success">
		<a href'#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		Profile successfully updated.
		</div>
		`;
	})
	.catch((error) => {
		//display error message
		message = document.getElementById("updateError");
		message.style.display='block';
		message.innerHTML = `
		<div class="alert alert-dismissible alert-danger">
		<a href'#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		${error.message};
		</div>
		`;
	});
});

const editPwd = document.getElementById("editPwd");

//changes user profile info
editPwd.addEventListener('submit', (e) => {
  e.preventDefault();

	var user = firebase.auth().currentUser;
	if (user) {
		if(validateInput("editPwd")){
			var newPassword = editPwd["password"].value;

			user.updatePassword(newPassword).then(function() {

				//close modal
				$('#pwdModal').modal("hide");
				editPwd.reset();

				//display success message
				var message = document.getElementById("editMsg");
				message.style.display='block';
				message.innerHTML = `
				<div class="alert alert-dismissible alert-success">
				<a href'#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				Profile successfully updated.
				</div
				`;
			}).catch(function(error) {
				//display error message
				message = document.getElementById("pwdError");
				message.style.display='block';
				message.innerHTML = `
				<div class="alert alert-dismissible alert-danger">
				<a href'#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				${error.message};
				</div>
				`;
			});
		}
	}
});
