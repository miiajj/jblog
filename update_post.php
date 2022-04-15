<?php 
session_start();
if(!isset($_SESSION['id'])) {
	header("location: ./form_signin.php");
	exit;
} 

if(isset($_POST['update_post'])) {
	$username = $_SESSION['username'];
	$id = $_SESSION['id'];
	$post_id = $_POST['post_id'];
	$title = $_POST['title'];
	$title_photo = $_FILES['title_photo'];
	if($title_photo['size'] > 0) {
		$file_name_arr = explode('.',$title_photo['name']);
		$last_index = count($file_name_arr) - 1;
		$file_ext = $file_name_arr[$last_index];
		$file_name = time() . '.' . $file_ext;
		$file_path = "photos/$username/" . $file_name;
		move_uploaded_file($title_photo["tmp_name"], $file_path);
	} else {
		$file_path = $_POST['title_photo_old'];
	}
	$content = $_POST['content'];

	require "./conn.php";
	$query_update_post = "update posts set title = '$title', title_photo = '$file_path', content = '$content' where account_id = unhex('$id') and id = '$post_id'";
	mysqli_query($conn,$query_update_post);
	mysqli_close($conn);
	header("location:./posts.php");
}
