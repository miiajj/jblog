<?php 
	require "./conn.php";
	$query_mpoint = "select count(*), MAX(point) from posts where isDeleted = 0";
	$result = mysqli_query($conn, $query_mpoint);
	$row = mysqli_fetch_array($result);
	$num_posts = $row[0];
	$max_point = $row[1];
	if($max_point > 0) {
		$query_hpost = "select title, title_photo, content from posts where isDeleted = 0 order by point desc limit 1";
		$query_posts = "select title, title_photo, content from posts where isDeleted = 0 order by point desc, created_date desc limit 4 offset 1";
	} else {
		$num_ran = rand(0,$num_posts-5);
		$query_hpost = "select title, title_photo, content from posts where isDeleted = 0 limit 1 offset $num_ran";
		$num_ran += 1;
		$query_posts = "select title, title_photo, content from posts where isDeleted = 0 order by created_date desc limit 4 offset $num_ran";
	}
	$result = mysqli_query($conn, $query_hpost);
	$hpost = mysqli_fetch_array($result);
	$htitle = $hpost['title'];
	$htitle_photo = $hpost['title_photo'];
	$hcontent = $hpost['content'];

	$posts = mysqli_query($conn, $query_posts);
	mysqli_close($conn);
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
	<link rel="icon" type="image/png" href="./assets/img/header-logo.png"/>
	<title>jBlog</title>
</head>
<body>
	<div class="header-banner" style="height:160px;outline:1px #ccc solid;">ads banner</div>
	<?php include "./common/header.php" ?>
	<div class="app">
		<div class="container">
			<div class="row">
				<div class="column-12">
					<div class="app-ctner">
						<div class="highlight-post">
							<div class="htitle-photo">
								<img src="<?php echo $htitle_photo ?>" width=100% height="200px" alt="title photo">
							</div>
							<div class="htitle"><?php echo htmlentities($htitle) ?></div>
							<div class="hcontent"><?php echo substr($hcontent,0,360) ?></div>
							<div class="post-author">
								<div class="post-author__avt"></div>
								<div class="post-author__name"></div>
								<div class="post-author__point"></div>
								<div class="post-author__view"></div>
								<div class="post-author__cmt"></div>
							</div>
						</div>
						<div class="post-ctn">
							<?php foreach ($posts as $post): ?>
							<div class="post">
								<div class="title-photo"><img src="<?php echo $post['title_photo'] ?>" alt="title photo"></div>
								<div class="post-ctn__content">
									<div class="title"><?php echo htmlentities($post['title']) ?></div>
									<div class="content"><?php echo htmlentities(substr($post['content'],0,360)) ?></div>
									<div class="post-author">
										<div class="post-author__avt"></div>
										<div class="post-author__name"></div>
										<div class="post-author__point"></div>
										<div class="post-author__view"></div>
										<div class="post-author__cmt"></div>
									</div>
								</div>
							</div>
							<?php endforeach ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include "./common/footer.php" ?>

</body>
</html>