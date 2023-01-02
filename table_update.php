<?php
$host = '127.0.0.1:3307';
$user = 'root';
$password = '';
$dbName = 'cateringmanagement';

$link = new MySQLi($host,$user,$password,$dbName);
if($link->connect_error){
	die("連結失敗".$link->connect_error);
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>餐桌狀態修改</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://classless.de/classless.css">
</head>
<body>
	<h1 align="center" valign="center">餐桌狀態修改</h1>
	<hr size="2px" align="center" color="#000000">
	<form align="center" action = "table_update.php" method = "POST">
	<h3>桌號編號:</h3>
	<?php
	$sql_check_table = "SELECT * FROM `diningtable`";
	$check_table_result = mysqli_query($link,$sql_check_table);
	echo "<select class='form-select' aria-label='Default select example' name = '桌號編號'>";
	if (mysqli_num_rows($check_table_result)> 0) {
		while ($row_table = mysqli_fetch_assoc($check_table_result)) {
		echo "<option value='{$row_table['桌號']}'>桌號: {$row_table['桌號']}</option>";
		}
	}
	echo "</select>";
	echo "<h3>修改狀態:</h3>";
	echo "<select class='form-select' aria-label='Default select example' name = '修改狀態'>";
		echo "<option value='可使用'>可使用</option>";
		echo "<option value='需清潔'>需清潔</option>";
		echo "<option value='入座'>入座</option>";
		echo "<option value='已訂位'>已訂位</option>";
	echo "</select>";
	?>
	<button>修改</button>
	</form>
	<?php
	@ $table_number = $_POST['桌號編號'];
	@ $update_state = $_POST['修改狀態'];
	$sql_update_state = "UPDATE `diningtable` SET `狀態` = '{$update_state}' WHERE `桌號` = '{$table_number}'";
	if($table_number != NULL and $update_state != NULL){
		$sql_update_state_result = mysqli_query($link,$sql_update_state);
		echo "<script language='JavaScript'>alert('修改成功');</script>";
	}
	?>
	<a href="handyman_data.php"><input type="button" value="返回"></button></a>
</body>
</html>
