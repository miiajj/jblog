<?php
    session_start();
	if(!isset($_SESSION['id'])) {
		header("location: ./form_signin.php");
		exit;
	}
	$id = $_SESSION['id'];
	require './conn.php';
	$query_num_of_posts = "select count(*) from posts where isDeleted = 0 and account_id = unhex('$id')";
	$result = mysqli_query($conn,$query_num_of_posts);
	$num_of_posts = mysqli_fetch_array($result)["count(*)"];
	$posts_per_page = 7;
	$num_of_pages = ceil($num_of_posts/$posts_per_page);
	if(!isset($_GET['page']) || $_GET['page'] < 1) {
		header("location:./posts.php?page=1");
	} else if($_GET['page'] > $num_of_pages) {
		header("location:./posts.php?page=$num_of_pages");
	} else {
		$current_page = $_GET['page'];
	}
	$skip_posts = $posts_per_page * ($current_page - 1);
	$query_posts = "select * from posts where account_id = unhex('$id') and isDeleted = 0 order by created_date desc limit $posts_per_page offset $skip_posts";
	$posts = mysqli_query($conn, $query_posts);
	mysqli_close($conn);

	$range_pages = 7;
	if($current_page < $range_pages/2) {
		$min = 1;
		$max = $range_pages;
	} else if($current_page > $num_of_pages - floor($range_pages/2)) {
		$max = $num_of_pages;
		$min = $num_of_pages - $range_pages + 1;
	} else {
		$min = $current_page - floor($range_pages/2);
		$max = $current_page + floor($range_pages/2);
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
	<link rel="stylesheet" type="text/css" href="./assets/css/header.css">
	<link rel="stylesheet" type="text/css" href="./assets/css/footer.css">
	<link rel="stylesheet" type="text/css" href="./assets/css/posts.css">

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
						<div class="posts-navbar">
							<ul class="posts-list">
								<li class="posts-item active">Bài viết</li>
								<li class="posts-item">Nháp</li>
							</ul>
						</div>
						<div class="posts-ctner">
							<?php if($num_of_posts === 0) : ?>
								<span>Bạn chưa có bài viết nào.</span>
							    <a href="./form_create_post.php" style="text-decoration: underline;">Tạo bài viết đầu tiên!</a>
							<?php else : ?>
							    <?php foreach ($posts as $post): ?>
									<div class="post-content">
										  <div class="post-title-photo" style="background-image: url(<?php echo $post["title_photo"] ?>);"></div>
										  <div class="post-content-ctn">
											  <div class="post-title" ><?php echo htmlentities($post["title"]) ?></div>
											  <div class="post-create-date"><?php echo $post["created_date"] ?></div>
											  <div class="post-details"><?php echo htmlentities(substr($post["content"],0,354)) ?></div>
										  </div>
										  <div class="post-ctrl">
											  <a href="./form_update_post.php?id=<?php echo $post["id"] ?>">Sửa</a>
											  <a href="./delete_post.php?id=<?php echo $post["id"] ?>">Xóa</a>	
										  </div>
									</div>
							    <?php endforeach ?>
							<?php endif; ?>
						</div>
						<?php if ($num_of_pages > $range_pages): ?>
						<div class="posts-page">
							<a href="./posts.php?page=1" class="posts-page__link">&lt;&lt;</a>
							<a href="./posts.php?page=<?php echo $current_page-1 ?>" class="posts-page__link">&lt;</a>
							<?php for ($i= $min; $i <= $max; $i++) {  ?>
								<?php if ($current_page == $i): ?>
									<a href="./posts.php?page=<?php echo $i ?>" class="posts-page__link active-page"><?php echo $i ?></a>
								<?php else: ?>
									<a href="./posts.php?page=<?php echo $i ?>" class="posts-page__link"><?php echo $i ?></a>
								<?php endif ?>
							<?php } ?>
							<a href="./posts.php?page=<?php echo $current_page+1 ?>" class="posts-page__link">&gt;</a>
							<a href="./posts.php?page=<?php echo $num_of_pages ?>" class="posts-page__link">&gt;&gt;</a>
						</div>
						<?php else: ?>
							<div class="posts-page">
							<?php if ($num_of_pages > 1): ?>
							<?php for ($i= 1; $i <= $num_of_pages; $i++) {  ?>
								<?php if ($current_page == $i): ?>
									<a href="./posts.php?page=<?php echo $i ?>" class="posts-page__link active-page"><?php echo $i ?></a>
								<?php else: ?>
									<a href="./posts.php?page=<?php echo $i ?>" class="posts-page__link"><?php echo $i ?></a>
								<?php endif ?>
							<?php } ?>
							<?php endif ?>
							</div>
						<?php endif ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include "./common/footer.php" ?>
</body>
</html>