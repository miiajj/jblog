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
$query_ctgs = "select categories.id as id, name, count(posts.id) as quantity, sum(ifnull(point,0)) as sum from categories left join posts on posts.categories_id = categories.id group by categories.id";
$ctgs = mysqli_query($conn, $query_ctgs);
mysqli_close($conn);

echo "<table style='width:68%;margin-bottom:40px'>";
echo "<tr>";
echo "<th style='width:8%;text-align:center'>ID</th>";
echo "<th style='width:20%;text-align:left'>Category</th>";
echo "<th style='width:12%;text-align:left'>Quantity</th>";
echo "<th style='width:8%;text-align:left'>Point</th>";
echo "<th style='width:8%;text-align:left'></th>";
echo "</tr>";
foreach ($ctgs as $ctg) {
	echo "<tr>";
	echo "<td style='text-align:center'>".$ctg["id"]."</td>";
	echo "<td>".$ctg["name"]."</td>";
	echo "<td>".$ctg["quantity"]."</td>";
	echo "<td>".$ctg["sum"]."</td>";
	if($ctg["quantity"] == 0) {
		echo "<td><form method='post' action='delete_category.php'><input name='id' hidden value=".$ctg['id']."><button type='submit'>Delete</button></form></td>";
	}
	echo "</tr>";
}
echo "</table>";

echo "<form action='add_category.php' method='post'>";
echo "<label for='ctg_add'>Thêm một thể loại mới:</label><br><br>";
echo "<input style='font-size:1.4rem;padding:8px 12px;margin-right:8px;' type='text' id='ctg_add' name='ctg_add' placeholder='Nhập tên...'>";
echo "<button type='submit' name='add' onclick= 'return check_empty(`add`)'>Thêm</button>";
echo "<div class='error'>Không được để trống</div>";
echo "</form><br><br>";
echo "<form action='update_category.php' method='post'>";
echo "<label>Sửa tên:</label><br><br>";
echo "<label for='ctgs'>Chọn:&nbsp;&nbsp;</label>";
echo "<select style='font-size:1.4rem;padding:8px 12px;margin-right:8px;' name='ctgs' id='ctgs'>";
foreach ($ctgs as $ctg) {
	echo "<option style='font-size:1.4rem;padding:8px 12px;margin-right:8px;' value=".$ctg['id'].">".$ctg['name']."</option>";
}
echo "</select>";
echo "<input style='font-size:1.4rem;padding:8px 12px;margin-right:8px;' type='text' id='ctg_update' name='ctg_update' placeholder='Nhập tên mới...'>";
echo "<button type='submit' name='update' onclick='return check_empty(`update`)'>Sửa</button>";
echo "<div class='error'>Không được để trống</div>";
echo "</form>";