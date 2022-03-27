<?php
session_start();

if(isset($_POST['signin'])) {
	$username = htmlspecialchars(stripslashes($_POST["username"]));
	$password = htmlspecialchars(stripslashes($_POST["password"]));

	$regex_username = "/^[a-zA-Z\d._]{6,}$/";
	$regex_password = "/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/";

	$_SESSION['error'] = array();

	if(strcmp($username, "") == 0) {
		array_push($_SESSION['error'], "username does not exist");
		header("location: ./form_signin.php");
	} else {
		require_once 'conn.php';
		$query_username = "select username from accounts where username = '$username'";
		$result_username = mysqli_query($conn, $query_username);
		if(!preg_match($regex_username, $username) || mysqli_num_rows($result_username) == 0) {
			array_push($_SESSION['error'], "username does not exist");
		} else if(strcmp($password, "") == 0 || !preg_match($regex_password, $password)) {
			array_push($_SESSION['error'], "wrong password");
		} else{
			$query_identify = "select hex(id_bin) as id_bin, username, password, lname, fname from accounts where username = '$username'";
			$result_password = mysqli_query($conn, $query_identify);
			$row = mysqli_fetch_array($result_password);
			if($row['password'] == md5($password)) {
				$_SESSION['username'] = $row['username'];
				$_SESSION['fname'] = $row['fname'];
				$_SESSION['lname'] = $row['lname'];
				if(isset($_POST['remember'])) {
					$token = uniqid('user_',true);
					$id_hex = $row['id_bin'];
					$query_utoken = "update accounts set token = '$token' where id_bin = unhex('$id_hex')";
					mysqli_query($conn, $query_utoken);
					setcookie("remember", $token, time() + 60*60*24*30);
				}
			} else {
				array_push($_SESSION['error'], "wrong password");
			}
		}
		mysqli_close($conn);

		if(empty($_SESSION['error'])) {
			header("location: ./user.php");
		} else {
			header("location: ./form_signin.php");
		}

	}
}