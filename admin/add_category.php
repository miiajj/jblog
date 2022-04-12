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
if(!isset($_POST['add']) || $_POST['ctg_add'] == '') {
	header('location:./');
	exit;
}
$ctg = $_POST['ctg_add'];
require "../conn.php";
$query_add_ctg = "insert into categories(name) values('$ctg')";
mysqli_query($conn, $query_add_ctg);
mysqli_close($conn);
header('location:./');