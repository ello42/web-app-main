//get current user
firebase.auth().onAuthStateChanged(function(user) {
	if (user) {
		// toggle user UI elements
		loggedInContent.forEach(item => item.style.display = 'block');
		loggedOutContent.forEach(item => item.style.display = 'none');
		//hide any error/info message boxes
		alerts.forEach(item => item.style.display = 'none');

		firebase.firestore().collection('users').doc(user.uid).onSnapshot((doc) => {

		  //display logged in user in upper right hand corner
		  var userName = document.getElementById("userInfo");
		  userName.innerHTML = doc.data().firstName + " " + doc.data().lastName;
		});
		

	} else {

		// toggle user UI elements
		loggedInContent.forEach(item => item.style.display = 'none');
		loggedOutContent.forEach(item => item.style.display = 'block');
	}
});