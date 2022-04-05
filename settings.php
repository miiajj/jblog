<?php
    session_start();
	if(!isset($_SESSION['id'])) {
		header("location: ./form_signin.php");
		exit;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,400;0,700;1,400;1,700&family=Roboto:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="./assets/css/reset.css">
	<link rel="stylesheet" type="text/css" href="./assets/css/base.css">
	<link rel="stylesheet" type="text/css" href="./assets/css/settings.css">

	<title>jBlog</title>
	<style>
		label {
			width: 80px;
			display: inline-block;
			margin-right: 12px;
		}
		form {
			float: left;
			display: inline-block;
		}
		button {
			margin-left: 228px;
		}
	</style>
</head>
<body>
	<?php include "./common/header.php" ?>
	<div class="app">
		<div class="container">
			<div class="row">
				<div class="column-12">
					<div class="app-ctner">
						<div class="settings-navbar">
							<ul class="settings-list">
								<li class="settings-item active">Thông tin cá nhân</li>
								<li class="settings-item">Tiểu sử</li>
								<li class="settings-item">Bài viết</li>
							</ul>
						</div>
						<div class="settings-ctner">
							<form action="update_account.php" method="post">
								<label for="avatar">Ảnh đại diện</label>
								<input type="file" accept="image/*" name="avatar" id="avatar" onchange="loadFile(event)"><br><br>
								<label for="lname">Last Name</label>
								<input type="text" name="lname" id="lname"><br><br>
								<label for="fname">First Name</label>
								<input type="text" name="fname" id="fname"><br><br>
								<label for="password">Password</label>
								<input type="text" name="password" id="password"><br><br>
								<label for="email">Email</label>
								<input type="email" name="email" id="email"><br><br>
								<label for="dob">Date of birth</label>
								<input type="date" name="dob" id="dob"><br><br>
								updating... <br><br>
								<button type="submit">Lưu</button>
							</form>
							<img id="avatar_preview" style="max-width:280px;margin-left:80px"><br>
							<div class="settings-bio">
								
							</div>
							<div class="settings-articles">
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include "./common/footer.php" ?>
	<script type="text/javascript">
		let loadFile = function(event) {
		    let output = document.getElementById('avatar_preview');
		    output.src = URL.createObjectURL(event.target.files[0]);
		    output.style.height = "180px";
		    output.onload = function() {
		      URL.revokeObjectURL(output.src) // free memory
		    }
		};
	</script>
</body>
</html>