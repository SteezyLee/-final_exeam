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
<title>刪除餐桌</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://classless.de/classless.css">
</head>

<body>
	<h1 align="center" valign="center">刪除餐桌</h1>
	<hr size="2px" align="center" color="#000000">
	<form align="center" action = "table_delete.php" method = "POST">
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
	?>
	<button>刪除</button>
	</form>
	<a href="table_state.php"><input type="button" value="返回"></button></a>
	<?php
	 @ $table_number = $_POST['桌號編號'];
	 $sql_check_table = "SELECT * FROM `diningtable` WHERE `桌號` = '{$table_number}'";
	 $sql_check_table_result = mysqli_query($link,$sql_check_table);
	 $delete_sql = "DELETE FROM `diningtable` WHERE `桌號` = '{$table_number}'";
	if(@ $table_number != null){
		$row_sql_check_table = mysqli_fetch_assoc($sql_check_table_result);
		if(($row_sql_check_table['狀態'] != '需清潔' or $row_sql_check_table['狀態'] != '已訂位')
		   and $row_sql_check_table['總金額'] == '0'){
			$delete_result = mysqli_query($link,$delete_sql);
			echo "<script language='JavaScript'>alert('刪除成功');</script>";
		}
		else{
			echo "<script language='JavaScript'>alert('此桌還尚未清潔或未結帳或已訂位');</script>";
		}
	}

	?>
</body>
</html>