<?php
session_start();

if (isset($_POST['submit'])) {
	$username = test_input($_POST["username"]);
	$password = test_input($_POST["password"]);
	$cpassword = test_input($_POST["cpassword"]);
	$email = test_input($_POST['email']);
	$fname = test_input($_POST["fname"]);
	$lname = test_input($_POST["lname"]);
	$dob = test_input($_POST["dob"]);
	$gender = isset($_POST["gender"]) ? $_POST["gender"] : "";

	$regex_username = "/^[a-zA-Z\d._]{6,}$/";
	$regex_password = "/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/";
	$regex_name = "/^([A-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪỬỮỰỲỴÝỶỸ][a-zàáâãèéêìíòóôõùúăđĩũơưăạảấầẩẫậắằẳẵặẹẻẽềềểễệỉịọỏốồổỗộớờởỡợụủứừửữựỳỵỷỹ'\-]* ?)*$/";
	$regex_dob = "/^([1-2]\d{3}[\/\-]((0?[1-9]|1[0-2])[\/\-](0?[1-9]|1\d|3[01])|(0?[13456789]|1[0-2])[\/\-]2\d|02[\/\-]2\d))$/";

	$_SESSION['error'] = array();
	if(	strcmp($username, "") == 0 || strcmp($password, "") == 0 ||
		strcmp($cpassword, "") == 0 || strcmp($email, "") == 0 ||
		strcmp($fname, "") == 0 || strcmp($lname, "") == 0 ||
		strcmp($dob, "") == 0 || strcmp($gender, "") == 0 ) {
		array_push($_SESSION['error'], "not filled full");
		header("location: ./form_signup.php");
	} else {
		if(!preg_match($regex_username, $username)) {
			array_push($_SESSION['error'], "wrong username format");
		} 
		if(!preg_match($regex_password, $password)) {
			array_push($_SESSION['error'], "wrong password format");
		}
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			array_push($_SESSION['error'], "wrong email format");
		}
		if(!preg_match($regex_name, $fname)) {
			array_push($_SESSION['error'], "wrong first name format");
		}
		if(!preg_match($regex_name, $lname)) {
			array_push($_SESSION['error'], "wrong last name format");
		}
		if(!preg_match($regex_dob, $dob) || new DateTime("now") < new DateTime($dob)) {
			array_push($_SESSION['error'], "wrong date format");
		}
		if (strcmp($password, $cpassword)) {
			array_push($_SESSION['error'], "password not match");
		}
		require_once 'conn.php';
		$query_username = "select username from accounts where username = '$username'";
		$query_email = "select email from accounts where email = '$email'";
		$result_username = mysqli_query($conn, $query_username);
		$result_email = mysqli_query($conn, $query_email);

		if(mysqli_num_rows($result_username) == 1) {
			array_push($_SESSION['error'], "username already exist");
		}
		if(mysqli_num_rows($result_email) == 1) {
			array_push($_SESSION['error'], "email already exist");
		}

		if(empty($_SESSION['error'])) {
			$query = "insert into accounts(id_bin,username,email,password,fname,lname,gender,dob) values(unhex(replace(uuid(), '-','')),'$username','$email','" . md5($password) . "',N'$fname',N'$lname',$gender,'$dob')";
			mysqli_query($conn, $query);
			require 'mail.php';
			$title = "Đăng ký thành công tài khoản Jblog";
			$content = "Chúc mừng bạn đã đăng ký thành công tài khoản Jblog! Chúng tôi sẽ bán thông tin mà bạn cung cấp cho hacker :) Ngu. ";
			mailler($email, $fname.$lname, $title, $content);
			$_SESSION['success_signup'] = "Sign up success";
			// create folder photo
			mkdir("photos/$username", 0770);
			header("location: ./form_signin.php");
		} else {
			header("location: ./form_signup.php");
		}
		mysqli_close($conn);
	}
}

function test_input($data) {
	return htmlspecialchars(stripslashes(trim($data)));
}

function duplicate_quote($data) {
	return preg_replace_callback("/[\']/", function($matches) {
		return $matches[0] . $matches[0];
	} , $data);
}