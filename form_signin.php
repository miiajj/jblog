<?php 
	session_start();
	if(isset($_COOKIE['remember'])) {
		$token = $_COOKIE['remember'];
		require './conn.php';
		$query = "select * from accounts where token = '$token' limit 1";
		$result = mysqli_query($conn, $query);
		$result_rows = mysqli_num_rows($result);
		if($result_rows == 1) {
			$row = mysqli_fetch_array($result);
			$_SESSION['id'] = $row['id_bin'];
			$_SESSION['username'] = $row['username'];
			$_SESSION['fname'] = $row['fname'];
			$_SESSION['lname'] = $row['lname'];
		}
	}
	if(isset($_SESSION['id'])) {
		header('location: ./index.php');
		exit;
	}
	if(isset($_SESSION['success_signup'])) {
		$success = $_SESSION['success_signup'];
		unset($_SESSION['success_signup']);
	}
	if(!empty($_SESSION['error'])) {
		$error = $_SESSION['error'];
		unset($_SESSION['error']);
		$error_usrn_note = $error[array_search("username does not exist", $error)];
		$error_wrongpwd = $error[array_search("wrong password", $error)];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="./assets/css/reset.css">
	<title>Sign in</title>
	<style>
		/*320a5c 4f1091 6c16c7 8930e8 a866ee c69cf4 e5d1fa */
		/*c70eb5 */
		body,html {
			display: flex;
			flex-direction: column;
			justify-content: center;
			min-height: 100vh;
			font-size: 62.5%;
		}
		.app-ctn {
			width: 600px;
			padding: 80px;
			margin: auto;
			outline: 4px #c70eb5 inset;
			box-sizing: border-box;
			font-size: 2rem;
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
		<?php if(isset($success)) { ?>
			<span style="color:green;"><?php echo $success; ?></span>
		<?php } else if(isset($error_usrn_note) && ($error_usrn_note === 'username does not exist')) {?>
			<span style="color:red;"><?php echo $error_usrn_note; ?></span>
		<?php } else if(isset($error_wrongpwd) && ($error_wrongpwd === 'wrong password')) { ?>
			<span style="color:red;"><?php echo $error_wrongpwd; ?></span>
		<?php } ?>
		<form method="post" action="signin.php">
			<h1>Signin</h1>
			<label for="username">username</label>
			<input type="text" name="username" id="username" autofocus><br><br>
			<label for="password">password</label>
			<input type="password" name="password" id="password"><br><br>
			<input type="checkbox" name="remember" id="remember">
			<label for="remember">remember me</label><br><br>
			<a style="color:#000;" href="./form_signup.php">Signup here</a>
			<button type="submit" name="signin">Sign in</button>
		</form>
	</div>
</body>
</html>