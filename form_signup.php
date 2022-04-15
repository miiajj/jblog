<?php
	session_start();
	if(isset($_SESSION['id'])) {
		header('location: ./index.php');
		exit;
	}
	if(!empty($_SESSION['error'])) {
		$error = $_SESSION['error'];
		unset($_SESSION['error']);
		$fillFull_error = $error[array_search('not filled full', $error)];
		$username_error = $error[array_search('wrong username format',$error)];
		$password_error = $error[array_search("wrong password format", $error)];
		$password_not_match = $error[array_search("password not match", $error)];
		$email_error = $error[array_search("wrong email format", $error)];
		$fname_error = $error[array_search("wrong first name format", $error)];
		$lname_error = $error[array_search("wrong last name format", $error)];
		$dob_error = $error[array_search("wrong date format", $error)];
		$exist_username = $error[array_search("username already exist", $error)];
		$exist_email = $error[array_search("email already exist", $error)];
	}
	// if(isset($_SESSION['name'])) {
	// 	echo $_SESSION['name'];
	// }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="./assets/css/reset.css">
	<title>Sign Up</title>
	<style>
		.error {
			position: absolute;
			margin-left: 4px;
			color: red;
			font-size: 1.6rem;
		}
		body,html {
			display: flex;
			flex-direction: column;
			justify-content: center;
			min-height: 100vh;
			font-size: 62.5%;
			position: relative;
		}
		.app-ctn {
			min-width: 600px;
			width: 45%;
			padding: 60px 20px;
			margin: auto;
			outline: 4px #c70eb5 inset;
			box-sizing: border-box;
			font-size: 1.8rem;
		}
		label {
			display: inline-block;
			width: 98px;
		}
		label[for="male"],
		label[for="female"] {
			width: unset;
		}
		h1 {
			font-size: 2.8rem;
			font-weight: 600;
			margin-bottom: 20px;
		}
		a {
			margin-right: 20px;
			border-bottom: 1px #c70eb5 solid;
		}
		a:hover {
			opacity: 0.4;
		}
		button {
			border: 1px #c70eb5 solid;
			background-color: #fff;
			padding: 8px 16px;
			cursor: pointer;
		}
		button:hover {
			background-color: #c70eb5;
			color: #fff;
		}
	</style>
</head>
<body>
	<div class="app-ctn">
		
		<form method="post" action="signup.php">
			<h1>Signup</h1>
			<label for="username">Username</label>
			<input type="text" name="username" id="username" autocomplete="off"><span class="error"><?php if(isset($username_error) && ($username_error === 'wrong username format')){echo $username_error;} if(isset($exist_username) && ($exist_username === 'username already exist')) {echo $exist_username;}?></span><br><br>
			<label for="password">Password</label>
			<input type="password" name="password" id="password"><span class="error"><?php if(isset($password_error) && ($password_error === 'wrong password format')){echo $password_error;} ?></span><br><br>
			<label for="cpassword">Confirm Password</label>
			<input type="password" name="cpassword" id="cpassword"><span class="error"><?php if(isset($password_not_match) && ($password_error === 'password not match')){echo $password_not_match;} ?></span><br><br>
			<label for="email">Email</label>
			<input type="email" name="email" id="email"><span class="error"><?php if(isset($email_error) && ($email_error === 'wrong email format')){echo $email_error;} if(isset($exist_email) && ($exist_email === 'email already exist')) {echo $exist_email;}?></span><br><br>
			<label for="fname">First Name</label>
			<input type="text" name="fname" id="fname"><span class="error"><?php if(isset($fname_error) && ($fname_error === 'wrong first name format')){echo $fname_error;} ?></span><br><br>
			<label for="lname">Last Name</label>
			<input type="text" name="lname" id="lname"><span class="error"><?php if(isset($lname_error) && ($lname_error === 'wrong last name format')){echo $lname_error;} ?></span><br><br>
			<label for="dob">Date of Birth</label>
			<input type="date" name="dob" id="dob"><span class="error"><?php if(isset($dob_error) && ($dob_error === 'wrong date format')){echo $dob_error;} ?></span><br><br>
			<label>Gender</label>
			<label for="male">Male</label>
			<input type="radio" name="gender" id="male" value="1">
			<label for="female">Female</label>
			<input type="radio" name="gender" id="female" value="0"><span class="error"></span><br><br>
			<a style="color:#000;" href="./form_signin.php">Signin here</a>
			<button type="submit" name="submit" onclick="return validate()">Submit</button><span class="error"><?php if(isset($fillFull_error) && ($fillFull_error === 'not filled full')) {echo $fillFull_error;} ?></span>
		</form>
		<noscript>To have a better experience please enable javascript or change to another browser.</noscript>
	</div>
	<script type="text/javascript">
		// function insertAfter(referenceNode, newNode) {
		// 	referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
		// } 
		let username = document.getElementById("username");
		let username_error = document.querySelector("#username + .error");

		let password = document.getElementById("password");
		let password_error =  document.querySelector("#password + .error");

		let cpassword = document.getElementById("cpassword");
		let cpassword_error =  document.querySelector("#cpassword + .error");

		let email = document.getElementById("email");
		let email_error =  document.querySelector("#email + .error");

		let fname = document.getElementById("fname");
		let fname_error =  document.querySelector("#fname + .error");

		let lname = document.getElementById("lname");
		let lname_error =  document.querySelector("#lname + .error");

		let dob = document.getElementById("dob");
		let dob_error =  document.querySelector("#dob + .error");

		let male = document.getElementById("male");
		let female = document.getElementById("female");
		let gender_error = document.querySelector("#female + .error");

		let regex_username = /^[a-zA-Z\d._]{6,}$/;
		let regex_password = /^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/;
		let regex_email = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		let regex_name = /^([A-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪỬỮỰỲỴÝỶỸ][a-zàáâãèéêìíòóôõùúăđĩũơưăạảấầẩẫậắằẳẵặẹẻẽềềểễệỉịọỏốồổỗộớờởỡợụủứừửữựỳỵỷỹ'\-]* ?)*$/;
		let regex_dob = /^[1-2]\d{3}[\/\-](((0?[1-9]|1[0-2])[\/\-](0?[1-9]|1\d|3[01])|(0?[13456789]|1[0-2])[\/\-]2\d|02[\/\-]2\d))$/;

		username.addEventListener("focus", function() {
			username_error.innerHTML = "";
			username.addEventListener("blur", isValidUsername);
		});
		function isValidUsername() {
			if(username.value == "") {
				username_error.innerHTML = "* Username is required!";
				return false;
			} else if(!regex_username.test(username.value)) {
				username_error.innerHTML = "* Wrong username format!";
				return false;
			}
			return true;
		}

		password.addEventListener("focus", function() {
			password_error.innerHTML = "";
			password.addEventListener("blur", isValidPwd);
		});
		function isValidPwd() {
			if(password.value == "") {
				password_error.innerHTML = "* Password is required!";
				return false;
			} else if(!regex_password.test(password.value)) {
				password_error.innerHTML = "* Password must be a minimum of 8 characters,<br> contain at least 1 number and 1 uppercase";
				return false;
			}
			if(password.value !== cpassword.value) {
				cpassword_error.innerHTML = "* Confirm password not match";
				return false;
			} else {
				cpassword_error.innerHTML = "";
			}
			return true;
		}

		cpassword.addEventListener("focus", function() {
			cpassword_error.innerHTML = "";
			cpassword.addEventListener("blur", isValidCPwd);
		});
		function isValidCPwd() {
			if(cpassword.value == "") {
				cpassword_error.innerHTML = "* Confirm password is required!";
				return false;
			} else if(cpassword.value !== password.value) {
				cpassword_error.innerHTML = "* Confirm password not match";
				return false;
			}
		}

		email.addEventListener("focus", function() {
			email_error.innerHTML = "";
			email.addEventListener("blur", isValidEmail);
		});
		function isValidEmail() {
			if(email.value == "") {
				email_error.innerHTML = "* Email is required!";
				return false;
			} else if(!regex_email.test(email.value)) {
				email_error.innerHTML = "* Wrong email format!";
				return false;
			}
			return true;
		}

		fname.addEventListener("focus", function() {
			fname_error.innerHTML = "";
			fname.addEventListener("blur", isValidFname);
		});
		function isValidFname() {
			if(fname.value == "") {
				fname_error.innerHTML = "* First name is required!";
				return false;
			} else if(!regex_name.test(fname.value)) {
				fname_error.innerHTML = "* Wrong first name format!";
				return false;
			}
			return true;
		}

		lname.addEventListener("focus", function() {
			lname_error.innerHTML = "";
			lname.addEventListener("blur", isValidLname);
		});
		function isValidLname() {
			if(lname.value == "") {
				lname_error.innerHTML = "* Last name is required!";
				return false;
			} else if(!regex_name.test(lname.value)) {
				lname_error.innerHTML = "* Wrong last name format!";
				return false;
			}
			return true;
		}

		fname.addEventListener("focus", function() {
			fname_error.innerHTML = "";
			fname.addEventListener("keyup",function() {
				fname.value = fname.value.toLowerCase()
							.replace(/^\s/g,"")
							.replace(/\s{2,}/g, " ")
							.replace(/^.|\s./g, function(a) {
					return a.toUpperCase();
				})
			});
			fname.addEventListener("blur", function() {
				fname.value = fname.value.trim();
			})
		});

		lname.addEventListener("focus", function() {
			lname_error.innerHTML = "";
			lname.addEventListener("keyup",function() {
				lname.value = lname.value.toLowerCase()
							.replace(/^\s/g,"")
							.replace(/ {2,}/g, " ")
							.replace(/^.| ./g, function(a) {
					return a.toUpperCase();
				})
			});
			lname.addEventListener("blur", function() {
				lname.value = lname.value.trim();
			})
		});

		dob.addEventListener("focus", function() {
			dob_error.innerHTML = "";
			dob.addEventListener("blur", isValidDob);
		});
		function isValidDob() {
			if(dob.value == "") {
				dob_error.innerHTML = "* Date of birth is required!";
				return false;
			} else if(!regex_dob.test(dob.value)) {
				dob_error.innerHTML = "* Wrong date of birth format!";
				return false;
			}
			return true;
		}

		male.addEventListener("click", isValidGender);
		female.addEventListener("click", isValidGender);

		function isValidGender() {
			if(!(male.checked || female.checked)) {
				gender_error.innerHTML = "* Gender is required!";
				return false;
			} else {
				gender_error.innerHTML = "";
			}
			return true;
		}

		function validate() {
			isValidUsername();
			isValidEmail();
			isValidPwd();
			isValidCPwd();
			isValidEmail();
			isValidFname();
			isValidLname();
			isValidDob();
			isValidGender();
			return 	isValidUsername() &&
					isValidEmail() &&
					isValidPwd() &&
					isValidCPwd() &&
					isValidEmail() &&
					isValidFname() &&
					isValidLname() &&
					isValidDob() &&
					isValidGender();
		}
	</script>
</body>
</html>