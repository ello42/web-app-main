//get current user
firebase.auth().onAuthStateChanged(function(user) {
	if (user) {

		firebase.firestore().collection('users').doc(user.uid).onSnapshot((doc) => {

		  //display logged in user in upper right hand corner
		  var userName = document.getElementById("userInfo");
		  userName.innerHTML = doc.data().firstName + " " + doc.data().lastName;
		});
		
		
	}
});
