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
<title>新增菜單</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://classless.de/classless.css">
</head>

<body>
	<h1 align="center" valign="center">新增菜單</h1>
	<hr size="2px" align="center" color="#000000">
	<form align="center" action = "order_add.php" method = "POST">
	<h3>桌號:</h3>
	<select class="form-select" aria-label="Default select example" name = '桌號'>
	<?php
	$sql_check_table_number = "SELECT `桌號` FROM `diningtable` order by `桌號` asc";
	$sql_check_menu_number = "SELECT `餐點名稱`,`金額` FROM `menu`";
	$table_result = mysqli_query($link,$sql_check_table_number);
	$menu_result = mysqli_query($link,$sql_check_menu_number);
	if (mysqli_num_rows($table_result) > 0) {
		while ($row = mysqli_fetch_assoc($table_result)) {
		$row = implode(" ",$row);
		echo "<option value='{$row}'>桌號: {$row}</option>";
		}
	}
	echo "</select>";
	echo "<h3>餐點名稱:</h3>";
	echo "<select class='form-select' aria-label='Default select example' name = '餐點名稱'>";
	if (mysqli_num_rows($menu_result) > 0) {
		while ($row_menu = mysqli_fetch_assoc($menu_result)) {
		echo "<option value='{$row_menu['餐點名稱']}'>{$row_menu['餐點名稱']}</option>";
		}
	}
	echo "</select>";
	echo "<h3>數量</h3>";
	echo "<input name = '數量'>";
	?>
	<button>新增</button>
	</form>
	<a href="waiter_data.php"><input type="button" value="返回"></button></a>
	<?php
	 @ $table_number = $_POST['桌號'];
	 @ $order_name = $_POST['餐點名稱'];
	 @ $order_number = $_POST['數量'];
	 $order_number_money = "SELECT `金額` FROM `menu` WHERE `餐點名稱` = '{$order_name}'";
	 @ $order_money = mysqli_query($link,$order_number_money);
	 @ $order_money = mysqli_fetch_assoc($order_money);
	@ $insert_sql = "INSERT INTO `order` (`ID`, `桌號`, `餐點`, `數量`, `金額`, `狀態`) VALUES (NULL,'{$table_number}','{$order_name}','{$order_number}','{$order_money['金額']}','未出餐')";
	if(@ $order_number != null){
	$insert_result = mysqli_query($link,$insert_sql);
	echo "<script language='JavaScript'>alert('新增成功');</script>";
	}
	?>
</body>
</html>
