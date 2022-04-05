<?php 
session_start();
if(!isset($_SESSION['id'])) {
	header("location: ./form_signin.php");
	exit;
} 

if(isset($_POST['create_post'])) {
	$id = $_SESSION['id'];
	$title = $_POST['title'];
	$title_photo = $_FILES['title_photo'];
	$content = $_POST['content'];

	require "./conn.php";
	$query_username = "select username from accounts where id_bin = unhex('$id')";
	$result = mysqli_query($conn,$query_username);
	$username = mysqli_fetch_array($result)['username'];

if($title_photo["size"] > 0) {
	$file_name_arr = explode('.',$title_photo['name']);
	$last_index = count($file_name_arr) - 1;
	$file_ext = $file_name_arr[$last_index];
	$file_name = time() . '.' . $file_ext;
	$file_path = "photos/$username/" . $file_name;
	move_uploaded_file($title_photo["tmp_name"], $file_path);	
} else {
	$file_path = null;
}

	$query_insert_post = "insert into posts(account_id,title,title_photo,content) values(unhex('$id'),'$title','$file_path','$content')";
	mysqli_query($conn,$query_insert_post);
	mysqli_close($conn);
	header("location:./index.php");
}
