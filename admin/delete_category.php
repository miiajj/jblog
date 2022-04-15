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

if(!isset($_POST['id'])) {
	header("location:../index.php");
	exit;
}

$id = $_POST['id'];
require "../conn.php";
$query_del = "delete from categories where id = $id";
mysqli_query($conn, $query_del);
mysqli_close($conn);
header("location:./");