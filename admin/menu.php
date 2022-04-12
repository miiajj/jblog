<?php 
session_start();
if($_SESSION['role'] != 1) {
	header("location: ../index.php");
	exit;
}