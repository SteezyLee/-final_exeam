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
<title>刪除菜單</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://classless.de/classless.css">
</head>

<body>
	<h1 align="center" valign="center">刪除菜單</h1>
	<hr size="2px" align="center" color="#000000">
	<form align="center" action = "order_delete.php" method = "POST">
	<h3>桌號:</h3>
	<select class="form-select" aria-label="Default select example" name = '桌號'>
	<?php
	$sql_check_table_number = "SELECT `桌號` FROM `diningtable` order by `桌號` asc";
	$table_result = mysqli_query($link,$sql_check_table_number);
	if (mysqli_num_rows($table_result) > 0) {
		while ($row = mysqli_fetch_assoc($table_result)) {
		$row = implode(" ",$row);
		echo "<option value='{$row}'>桌號: {$row}</option>";
		}
	}
	echo "</select>";
	echo "<button>查詢</button>";
	?>
	</form>
	<?php
	@ $check_table = $_POST["桌號"];
	$sql_check_order = "SELECT * FROM `order` WHERE `桌號` = {$check_table};";
	$check_order_result = mysqli_query($link,$sql_check_order);
	echo "<form align='center' action = 'order_delete.php' method = 'POST'>";
	if (@ mysqli_num_rows($check_order_result) > 0) {
		while ($order_row = mysqli_fetch_assoc($check_order_result)) {
		echo "<div class='form-check'>
  			 <input class='form-check-input' type='checkbox' value='{$order_row['ID']}' id='{$order_row['ID']}' name = 'order_delete[]' checked>
  			 <label class='form-check-label' for='flexCheckChecked'>餐點: {$order_row['餐點']} 數量: {$order_row['數量']}  金額: {$order_row['金額']}</label></div>";
		}
	}
	echo "<button>刪除</button>";
	echo "</form>";
	@ $order_delete = $_POST['order_delete'];
	if(@ count($order_delete) > 0){
	for( $i=0 ; $i < count($order_delete) ; $i++){
			$delete_sql = "DELETE FROM `order` WHERE `ID` = $order_delete[$i]";
			$delete_sql_result = mysqli_query($link,$delete_sql);
			echo "<script language='JavaScript'>alert('刪除成功');</script>";
		}
	}
	?>
	<a href="waiter_data.php"><input type="button" value="返回"></button></a>
</body>
</html>
