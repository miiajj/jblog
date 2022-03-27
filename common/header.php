<?php 
	if (!isset($_SESSION)) {
	    session_start();
	}
	if(isset($_SESSION['username'])) {
		$name = $_SESSION['lname'] ." ". $_SESSION['fname'];
		$username = $_SESSION['username'];
	}
?>
<link rel="stylesheet" type="text/css" href="./assets/css/header.css">
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
</script>
<div class="header-banner">ads banner</div>
<div class="header">
	<div class="container">
		<div class="row">
			<div class="column-3">
				<div class="header-logo">
					<a href="../index.php" class="header-logo__link"></a>
				</div>
			</div>
			<div class="column-5">
				<div class="header-ctr">
					<div class="header-ctr__weather">
						Ở đây sẽ để ngày tháng và thời tiết
					</div>
					<div class="header-ctr__search">
						<div class="header-ctr__search-input">
							<input type="text" name="search" placeholder="Tìm kiếm" size="28">
						</div>
						<button class="header-ctr__search-btn">
							<script src="https://cdn.lordicon.com/lusqsztk.js"></script>
							<lord-icon
							    src="https://cdn.lordicon.com/qehhcbpv.json"
							    trigger="hover"
							    colors="primary:#4f1091"
							    state="hover"
							    style="width:28px;height:28px">
							</lord-icon>
						</button>
					</div>
				</div>
			</div>
			
			<div class="column-4">
				<div class="header-identifer">
					<?php if(isset($name)) { ?>
					<div class="header-accnt">
						<div class="header-accnt-ctn">
							<span><?php echo "$name" ?></span>
							<div class="header-accnt-avt"></div>
						</div>
						<ul class="header-accnt-menu">
							<li class="header-accnt-menu__item">
								<a class="header-accnt-menu__link" href="#">Thông tin tài khoản</a>
							</li>
							<li class="header-accnt-menu__item">
								<a class="header-accnt-menu__link" href="./form_create_post.php">Tạo bài viết mới</a>
							</li>
							<li class="header-accnt-menu__item">
								<a class="header-accnt-menu__link" href="#">Bài viết của bạn</a>
							</li>
							<li class="header-accnt-menu__item">
								<a class="header-accnt-menu__link" href="#">Cài đặt</a>
							</li>
							<li class="header-accnt-menu__item">
								<a class="header-accnt-menu__link" href="./signout.php">Đăng xuất</a>
							</li>
						</ul>
					</div>
					<script type="text/javascript">
						toggle_account();
					</script>
					<?php } else { ?>
					<div>
						<a class="header-identifer__signin" href="./form_signin.php">Đăng nhập</a>
						<span class="slash">/</span>
						<a class="header-identifer__signup" href="./form_signup.php">Đăng ký</a>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="column-12">
				<div class="header-navbar">
					<a href="../" class="header-navbar__home">
						<script src="https://cdn.lordicon.com/lusqsztk.js"></script>
						<lord-icon
						    src="https://cdn.lordicon.com/igpbsrza.json"
						    trigger="morph"
						    colors="primary:#4f1091"
						    style="width:48px;height:48px">
						</lord-icon>
					</a>
					<ul class="ctg">
						<li class="ctg-item">
							<a class="ctg-item__link" href="#">Tâm sự</a>
						</li>
						<li class="ctg-item">
							<a class="ctg-item__link" href="#">Lập trình</a>
						</li>
						<li class="ctg-item">
							<a class="ctg-item__link" href="#">Khoa học</a>
						</li>
						<li class="ctg-item">
							<a class="ctg-item__link" href="#">Sách</a>
						</li>
						<li class="ctg-item">
							<a class="ctg-item__link" href="#">Phượt</a>
						</li>
						<li class="ctg-item">
							<a class="ctg-item__link" href="#">Truyền cảm hứng</a>
						</li>
						<li class="ctg-item">
							<a class="ctg-item__link" href="#">Chat all chửi nhau</a></li>
						<li class="ctg-item">
							<a class="ctg-item__link" href="#">Chat all chửi nhau</a>
						</li>
						<li class="ctg-item">
							<a class="ctg-item__link" href="#">Chat all chửi nhau</a>
						</li>
						<li class="ctg-item">
							<a class="ctg-item__link" href="#">Chat all chửi nhau</a>
						</li>
						<li class="ctg-item">
							<a class="ctg-item__link" href="#">Chat all chửi nhau</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
