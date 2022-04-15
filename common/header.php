<?php 
	if (!isset($_SESSION)) {
	    session_start();
	}
	if(isset($_SESSION['id'])) {
		$name = $_SESSION['name'];
		$username = $_SESSION['username'];
		$role = $_SESSION['role'];
	}
?>
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
<div class="header">
	<div class="container">
		<div class="header-top">
			<div class="row">
				<div class="column-4">
					<div class="header-logo">
						<a href="../index.php" class="header-logo__link"></a>
					</div>
				</div>
				<div class="column-4">
					<div class="header-ctr">
						<div class="header-ctr__weather">
							Ở đây sẽ để ngày tháng và thời tiết
						</div>
						<div class="header-ctr__search">
							<form id="search">
								<input type="text" name="search" placeholder="Tìm kiếm" size="28">
								<button type="submit" class="header-ctr__search-btn">
									<script src="https://cdn.lordicon.com/lusqsztk.js"></script>
									<lord-icon
									    src="https://cdn.lordicon.com/qehhcbpv.json"
									    trigger="hover"
									    colors="primary:#4f1091"
									    state="hover"
									    style="width:28px;height:28px">
									</lord-icon>
								</button>
							</form>
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
									<a class="header-accnt-menu__link" href="#">Trang của bạn</a>
								</li>
								<li class="header-accnt-menu__item">
									<a class="header-accnt-menu__link" href="/jblog/form_create_post.php">Tạo bài viết mới</a>
								</li>
								<li class="header-accnt-menu__item">
									<a class="header-accnt-menu__link" href="/jblog/posts.php">Bài viết của bạn</a>
								</li>
								<li class="header-accnt-menu__item">
									<a class="header-accnt-menu__link" href="/jblog/settings.php">Cài đặt</a>
								</li>
								<?php if ($role == 1): ?>
								<li class="header-accnt-menu__item">
									<a class="header-accnt-menu__link" href="/jblog/admin/">Quản lý</a>
								</li>
								<?php endif ?>
								<li class="header-accnt-menu__item">
									<a class="header-accnt-menu__link" href="/jblog/signout.php">Đăng xuất</a>
								</li>
							</ul>
						</div>
						<script type="text/javascript">
							toggle_account();
						</script>
						<?php } else { ?>
						<div>
							<a class="header-identifer__signin" href="/jblog/form_signin.php">Đăng nhập</a>
							<span class="slash">/</span>
							<a class="header-identifer__signup" href="/jblog/form_signup.php">Đăng ký</a>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<div class="header-bottom">
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
</div>
<style>
		.highlight-post, .post-ctn {
			float: left;
			line-height: 20px;
			margin-top: 60px;
		}
		.highlight-post {
			width: 40%;
			padding: 0 28px 0 20px;
		}
		.post-ctn {
			width: 60%;
			padding-left:32px;
			margin-bottom: 120px;
		}
		.post {
			display: flex;
			margin-bottom: 56px;
		}
		.htitle, .title {
			font-size: 2rem;
			line-height: 2.4rem;
			font-weight: 500;
		  	overflow-wrap: break-word;
		  	display: -webkit-box;
			-webkit-line-clamp: 2;
			-webkit-box-orient: vertical;
			overflow: hidden;
		}
		.htitle {
			margin: 16px 0;
		}
		.post-ctn__content {
			margin: 0 16px;
			width: 100%;
		}
		.htitle-photo>img {
			object-fit: cover;
			object-position: 50% 50%;
			width: 100%;
			height: 240px;
		}
		.title-photo {
			flex-basis: 45%;
		}
		.title-photo>img {
			object-fit: cover;
			object-position: 50% 50%;
			height: 160px;
			width: 100%;
			min-width: 160px;
		}
		.hcontent, .content {
			color: #333;
			font-size: 1.6rem;
			word-break: break-all;
			display: -webkit-box;
			-webkit-line-clamp: 2;
			-webkit-box-orient: vertical;
			overflow: hidden;
		}
		.content {
			margin-top: 16px;
		}
		.post-author {
			margin-top: 16px;
			width: 100%;
			height: 56px;
			display: flex;
			background-color: #e5d1fa;
		}
	</style>
	<script>
		const form = document.getElementById("search");
		form.addEventListener('submit', loadSearch);
		const input = form.querySelector("input[name=search]");
		function loadSearch(event) {
			event.preventDefault();
			const xhttp = new XMLHttpRequest();
			const search = input.value;
			xhttp.onload = function() {
				if(this.responseText) {
					document.getElementsByClassName("app-ctner")[0].innerHTML = this.responseText;
				}
			}
			xhttp.open("GET", "/jblog/search_posts.php?search=" + search, true);
			xhttp.send();
		}
	</script>