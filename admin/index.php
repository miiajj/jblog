<?php 
session_start();
if(!isset($_SESSION['id'])) {
	header("location: ../signin.php");
	exit;
}
if($_SESSION['role'] != 1) {
	header("location: ../index.php");
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
	<link rel="stylesheet" type="text/css" href="../assets/css/reset.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/base.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/header.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/footer.css">
	<link rel="icon" type="image/png" href="../assets/img/header-logo.png"/>
	<title>jBlog</title>
	<style>
		.manager-navbar {
		  float: left;
		  position: sticky;
		  position: -webkit-sticky;
		  z-index: 1;
		  top: 160px;
		  left: 0;
		  padding-top: 60px;
		  width: 192px;
		  overflow: hidden;
		}
		.manager-item {
		  padding: 12px 24px;
		  font-size: 1.6rem;
		  border-left: 2px transparent solid;
		  border-right: 1px #ccc solid;
		  color: #333;
		  cursor: pointer;
		}
		.manager-item:not(.active):hover {
		  color: #8930e8;
		}
		.manager-item.active {
		  border-left: 2px #a866ee solid;
		  color: #4f1091;
		  font-weight: 500;
		}
		.manager-ctner {
		  margin-left: 200px;
		  padding: 60px 40px 0;
		  border: 2px #e5d1fa solid;
		  border-radius: 0 24px 24px 0;
		  border-left-color: transparent;
		  overflow-x: auto;
		  min-height: 600px;
		}
		table {
			margin: 0 auto;
		}
		tr {
			max-height: 90px;
			border-bottom: 1px #e5d1fa solid;
		}
		tr:last-child {
			border-bottom: 1px transparent solid;
		}
		th {
			padding-bottom: 16px;
		}
		td {
			vertical-align: top;
			padding: 12px 4px;
			overflow-y: auto;
		}
		button[name=add], button[name=update] {
			font-size: 1.4rem;
			border: 1px #c70eb5 solid;
			background-color: #fff;
			padding: 8px 16px;
			cursor: pointer;
			margin-right: 8px;
		}
		button[name=add]:hover, button[name=update]:hover {
			background-color: #c70eb5;
			color: #fff;
		}
		.error {
			color: red;
			display: none;
		}
	</style>
</head>
<body onload="getData('post_manager.php')">
	<?php include "../common/header.php" ?>
	<div class="app">
		<div class="container">
			<div class="row">
				<div class="column-12">
					<div class="app-ctner">
						<div class="manager-navbar">
							<ul class="manager-list">
								<li class="manager-item active" data="post_manager">Quản lý bài viết</li>
								<li class="manager-item" data="category_manager"">Quản lý thể loại</li>
								<li class="manager-item" data="account_manager">Quản lý tài khoản</li>
							</ul>
						</div>
						<div class="manager-ctner">
							<div id="manager-details"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include "../common/footer.php" ?>
	<script>
		let list = document.querySelectorAll('.manager-item');
		list.forEach((item) => {
			item.onclick = function() {
				if(item.classList.contains('active')) {
					return false;
				}
				let actItem = document.querySelector('.manager-item.active').classList.remove('active');
				let link = this.getAttribute("data") + ".php";
				getData(link);
				this.classList.add('active');
			}
		})

		function getData(link) {
		  const xhttp = new XMLHttpRequest();
		  xhttp.onload = function() {
		    document.getElementById("manager-details").innerHTML = this.responseText;
		  }
		  xhttp.open("post", link);
		  xhttp.send();   
		}
		function check_empty(type) {
			let type_err = 'button[name='+ type +'] + .error';
			let error = document.querySelector(type_err);
			let field = '#ctg_' + type;
			let inputField = document.querySelector(field);
			if(inputField.value == '') {
				error.style.display = 'inline-block';
				return false;
			}
			return true;
		}
	</script>
</body>
</html>