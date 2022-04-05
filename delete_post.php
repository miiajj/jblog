<?php 
session_start();
if(!isset($_SESSION['id'])) {
	header("location: ./form_signin.php");
	exit;
} 

$id = $_SESSION['id'];
$post_id = $_GET['id'];
require "./conn.php";
$query_del_post = "update posts set isDeleted = 1 where account_id = unhex('$id') and id = '$post_id'";
mysqli_query($conn,$query_del_post);
mysqli_close($conn);
header("location:./posts.php");
