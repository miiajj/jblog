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
require "../conn.php";
$query_posts = "select id, title, title_photo, content, created_date, isDeleted, username, email, isClosed from posts join accounts on account_id = id_bin order by id desc limit 20 offset 0";
$posts = mysqli_query($conn, $query_posts);
mysqli_close($conn);
echo "<table style='width:100%'>";
echo "<tr>";
echo "<th style='width:4%;text-align:left;padding-left:4px'>ID</th>";
echo "<th style='width:10%'>Created date</th>";
echo "<th style='width:16%'>Title</th>";
echo "<th style='width:12%'>Title photo</th>";
echo "<th style='width:28%'>Content</th>";
echo "<th style='width:8%'>Is deleted</th>";
echo "<th style='width:12%'>Username</th>";
echo "<th style='width:10%'>Email</th>";
echo "</tr>";
foreach ($posts as $post) {
	if($post['isDeleted'] == 1) {
		echo "<tr style='background-color:#eee8f6'>";
	} else {
		echo "<tr>";
	}
	echo "<td style='text-align:left'>".$post["id"]."</td>";
	echo "<td>".date('H:i:s d/m/Y',strtotime($post["created_date"]))."</td>";
	echo "<td style='word-break:break-all;display:inline-block;width:100%;min-width:68px;height:100%;max-height:90px'>".htmlentities($post["title"])."</td>";
	echo "<td style='vertical-align:middle;text-align:center'><img style='max-height:90px;max-width:100%;' src=/jblog/".$post["title_photo"]."></td>";
	echo "<td style='word-break:break-all;display:inline-block;width:100%;min-width:68px;height:100%;max-height:90px'>".htmlentities($post["content"])."</td>";
	echo "<td style='text-align:center'>".$post["isDeleted"]."</td>";
	echo "<td>".$post["username"]."</td>";
	echo "<td>".$post["email"]."</td>";
	echo "</tr>";
}
echo "</table>";
