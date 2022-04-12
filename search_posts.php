<?php
$search = $_GET['search'];
$page = 1;
if(isset($_GET['page'])) {
	$page = $_GET['page'];
}
require "./conn.php";
$posts_per_page = 10;
$offset = $posts_per_page * ($page - 1);
$query_posts = "select * from posts where isDeleted = 0 and lower(title) like binary '%$search%' limit $posts_per_page offset $offset";
$posts = mysqli_query($conn, $query_posts);
mysqli_close($conn);
echo "<div class='post-ctn' style='width:100%'>";
foreach ($posts as $post) {
	echo "<div class='post'>";
	echo "<div class='title-photo'><img src='/jblog/" . $post['title_photo'] . "'alt='title photo'></div>";
	echo "<div class='post-ctn__content'>";
	echo "<div class='title'>" . $post['title'] . "</div>";
	echo "<div class='content'>" . substr($post['content'],0,360) ."</div>";
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
echo "</div>";