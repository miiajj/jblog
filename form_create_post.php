<?php 
	if (!isset($_SESSION)) {
	    session_start();
	}
	if(!isset($_SESSION['id'])) {
		header("location: ./form_signin.php");
	}
		$id = $_SESSION['id'];
		$name = $_SESSION['name'];
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
	<title>Create Post</title>
	<style>
		.header {
		  position: sticky;
		  position: -webkit-sticky;
		  top: 0;
		  z-index: 1;
		  display: flex;
		  justify-content: space-between;
		  align-items: center;
		  font-size: 1.6rem;
		}
		.header-logo {
		  height: 80px;
		  min-width: 180px;
		  background: #fff url("./assets/img/header-logo.png") no-repeat left center;
		  background-size: 200px 200px;
		  background-origin: border-box;
		}
		.header-logo__link {
		  display: block;
		  width: 100%;
		  height: 100%;
		}
		.header-accnt {
		  border: 1px rgba(198, 156, 244, 0.24) solid;
		  transition: box-shadow 0.2s ease;
		  box-shadow: 8px 8px 16px 8px rgba(198, 156, 244, 0.12);
		  border-radius: 20px;
		  position: relative;
		  height: 44px;
		  font-family: "Noto Sans", sans-serif;
		  font-size: 1.4rem;
		  line-height: 2.4rem;
		}
		.header-accnt:hover {
		  box-shadow: 4px 4px 8px 4px rgba(198, 156, 244, 0.12);
		}
		.header-accnt:hover .header-accnt-menu {
		  box-shadow: 4px 4px 8px 4px rgba(198, 156, 244, 0.12);
		}
		.header-accnt-ctn {
		  min-width: 154px;
		  max-width: 220px;
		  display: flex;
		  align-items: center;
		  justify-content: flex-end;
		  padding: 4px 8px;
		  cursor: pointer;
		  user-select: none;
		}
		.header-accnt-avt {
		  width: 36px;
		  min-width: 36px;
		  height: 36px;
		  min-height: 32px;
		  margin-left: 8px;
		  border: 1px rgba(198, 156, 244, 0.24) solid;
		  box-shadow: 1px 1px 2px rgba(198, 156, 244, 0.12);
		  border-radius: 16px;
		  background: #fff url() no-repeat center center;
		  background-origin: border-box;
		}
		.header-accnt-menu {
		  display: none;
		  position: absolute;
		  top: calc(100% + 4px);
		  left: 0;
		  width: 100%;
		  z-index: 1;
		  background-color: #fff;
		  border-radius: 16px;
		  outline: 1px rgba(198, 156, 244, 0.24) solid;
		  overflow: hidden;
		  box-shadow: 8px 8px 16px 8px rgba(198, 156, 244, 0.12);
		  transition: box-shadow 0.24s ease;
		}
		.header-accnt-menu:hover {
		  box-shadow: 4px 4px 8px 4px rgba(198, 156, 244, 0.12);
		}
		.header-accnt-menu__item {
		  position: relative;
		  cursor: pointer;
		  user-select: none;
		}
		.header-accnt-menu__item:hover {
		  background-color: rgba(198, 156, 244, 0.24);
		}
		.header-accnt-menu__item:not(:first-child)::before {
		  content: "";
		  position: absolute;
		  width: 60%;
		  height: 1px;
		  top: 0;
		  left: 20%;
		  background-color: rgba(198, 156, 244, 0.16);
		}
		.header-accnt-menu__item:first-child > .header-accnt-menu__link {
		  padding-top: 12px;
		}
		.header-accnt-menu__item:last-child > .header-accnt-menu__link {
		  padding-bottom: 12px;
		}
		.header-accnt-menu__link {
		 	padding: 8px 12px;
		    display: inline-block;
		    width: 100%;
		    height: 100%;
		    color: #320a5c;
		}
		.creation {
			width: 68vw;
			height: 50%;
			margin: 0 auto;
		}
		form {
			margin-top: 20px;
			text-align: center;
			font-size: 1.6rem;
			height: 100%;
			position: relative;
		}
		.title_photo {
			margin: 12px 12px 0 0;
		}
		input[type="text"] {
			font-size: 2.4rem;
			font-weight: 600;
			margin-bottom: 20px;
		}
		input[type="text"], textarea {
			border: none;
			outline: none;
			width: 64%;
		}
		textarea {
			height: 100%;
			line-height: 2.4rem;
			font-size: 1.6rem;
			margin-top: 12px;
		}
		button[type="submit"] {
			position:absolute;
			left:100%;
			bottom:0;
			width: 100px;
			font-size: 1.6rem;
			cursor: pointer;
			border: 2px #c70eb5 outset;
			background-color: #fff;
			padding: 8px 12px;
			cursor: pointer;
		}
		button:hover {
			background-color: #c70eb5;
			color: #fff;
		}
	</style>
	<script type="text/javascript">
		function toggle_account() {
	  	document.addEventListener("click", function(e) {
	      let header_accnt_ctn = document.getElementsByClassName('header-accnt-ctn')[0];
	      let header_accnt_menu = document.getElementsByClassName('header-accnt-menu')[0];
				let click_target = e.target; // clicked element    
	      do {
	        if(click_target == header_accnt_ctn) {
	          // This is a click inside, does nothing, just return.
	          if(getComputedStyle(header_accnt_menu).display === 'none' || header_accnt_menu.style.display === 'none') {
							header_accnt_menu.style.setProperty('display', 'block');
						} else {
							header_accnt_menu.style.setProperty('display', 'none');
						}
		          return;
	        }
	        // Go up the DOM
	        click_target = click_target.parentNode;
	      } while (click_target);
	      // This is a click outside.
	      header_accnt_menu.style.setProperty('display', 'none');
	    });
		}
		let loadFile = function(event) {
		    let output = document.getElementById('title_photo_preview');
		    output.src = URL.createObjectURL(event.target.files[0]);
		    output.style.maxWidth = "400px";
		    output.style.maxHeight = "400px";
		    output.style.margin = "12px";
		    output.onload = function() {
		      URL.revokeObjectURL(output.src) // free memory
		    }
		};
	</script>
</head>
<body>
	<div class="app">
		<div class="container">
			<div class="row">
				<div class="column-12" style="height: 98vh;">
					<div class="header">
						<div class="header-logo">
							<a href="./index.php" class="header-logo__link"></a>
						</div>
						<div class="header-accnt">
							<div class="header-accnt-ctn">
								<span><?php echo "$name" ?></span>
								<div class="header-accnt-avt"></div>
							</div>
							<ul class="header-accnt-menu">
								<li class="header-accnt-menu__item">
									<a class="header-accnt-menu__link" href="./#">Trang của bạn</a>
								</li>
								<li class="header-accnt-menu__item">
									<a class="header-accnt-menu__link" href="./form_create_post.php">Tạo bài viết mới</a>
								</li>
								<li class="header-accnt-menu__item">
									<a class="header-accnt-menu__link" href="./posts.php">Bài viết của bạn</a>
								</li>
								<li class="header-accnt-menu__item">
									<a class="header-accnt-menu__link" href="./settings.php">Cài đặt</a>
								</li>
								<li class="header-accnt-menu__item">
									<a class="header-accnt-menu__link" href="./signout.php">Đăng xuất</a>
								</li>
							</ul>
						</div>
						<script type="text/javascript">
							toggle_account();
						</script>
					</div>
					<div class="creation">
						<form action="create_post.php" method="post" enctype='multipart/form-data'>
							<input type="text" name="title" placeholder="title here..."><br><br>
							<label for="title_photo">Title photo</label>
							<input type="file" accept="image/*" name="title_photo" id="title_photo" onchange="loadFile(event)"><br><br>
							<img id="title_photo_preview">
							<textarea name="content" placeholder="Content here..."></textarea><br><br>
							<button type="submit" name="create_post">Đăng bài</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>