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
if(!isset($_POST['update']) || $_POST['ctg_update'] == '') {
	header('location:./');
	exit;
}

$id = $_POST['ctgs'];
$ctg_update = $_POST['ctg_update'];
require "../conn.php";
$query_update = "update categories set name = '$ctg_update' where id = $id";
mysqli_query($conn, $query_update);
mysqli_close($conn);
header('location:./');