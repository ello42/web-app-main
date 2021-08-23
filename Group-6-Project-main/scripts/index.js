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
		isPremium(user);
	} else {
		// toggle user UI elements
		loggedInContent.forEach(item => item.style.display = 'none');
		loggedOutContent.forEach(item => item.style.display = 'block');
	}
});

//make sure user is allowed to access exams
function isPremium(user){

	var string = "";
	//read list of exams from Firebase Firestore
	firebase.firestore().collection("exams").get().then((querySnapshot) => {
		querySnapshot.forEach((doc) => {
			const exam = doc.data();
			const examCard = `
				<div class="column">
					<div class="card">
						<h4><a href='./exam.html?exam=${exam.title}' style='text-decoration:none;'><b>${exam.title}</b></a></h4>
						<hr>
						<p>Sections: ${exam.sections}</p>
						<p>Total questions: ${exam.questions}</p>
						<p>Time limit: ${exam.time}</p>
					</div>
				</div>
			`;
			string += examCard;
		});
		//display exams
		var exams = document.getElementById("exams");
		exams.innerHTML = string;
	});
	
}

