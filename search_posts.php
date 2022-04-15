<?php
$search = htmlspecialchars(addslashes(trim($_GET['search'])));
if(isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = 1;
}

if(!isset($search)) {
	exit();
}
require "./conn.php";
$query_num_of_posts = "select count(*) from posts where isDeleted = 0 and title like '%$search%'";
$result = mysqli_query($conn,$query_num_of_posts);
$num_of_posts = mysqli_fetch_array($result)["count(*)"];
$posts_per_page = 7;
$num_of_pages = ceil($num_of_posts/$posts_per_page);
if($page > $num_of_pages || $page < 1) {
	$page = 1;
}
$skip_posts = $posts_per_page * ($page - 1);

$range_pages = 7;
if($page < $range_pages/2) {
	$min = 1;
	$max = $range_pages;
} else if($page > $num_of_pages - floor($range_pages/2)) {
	$max = $num_of_pages;
	$min = $num_of_pages - $range_pages + 1;
} else {
	$min = $page - floor($range_pages/2);
	$max = $page + floor($range_pages/2);
}

$query_posts = "select * from posts where isDeleted = 0 and lower(title) like binary '%$search%' order by id desc limit $posts_per_page offset $skip_posts";
$posts = mysqli_query($conn, $query_posts);
mysqli_close($conn);
if($num_of_posts = 0) {
	echo "Không có bài viết tương ứng.";
} else {
	echo "<div class='post-ctn' style='width:100%'>";
	foreach ($posts as $post) {
		echo "<div class='post'>";
		echo "<div class='title-photo'><img src='/jblog/" . $post['title_photo'] . "'alt='title photo'></div>";
		echo "<div class='post-ctn__content'>";
		echo "<div class='title'>" . htmlentities($post['title']) . "</div>";
		echo "<div class='content'>" . htmlentities(substr($post['content'],0,360)) ."</div>";
		echo "<div class='post-author'>";
		echo "<div class='post-author__avt'></div>";
		echo "<div class='post-author__name'></div>";
		echo "<div class='post-author__point'></div>";
		echo "<div class='post-author__view'></div>";
		echo "<div class='post-author__cmt'></div>";
		echo "</div>";
		echo "</div>";
		echo "</div>";
	}
}
echo "</div>";