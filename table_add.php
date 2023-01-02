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
<title>新增餐桌</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://classless.de/classless.css">
</head>

<body>
	<h1 align="center" valign="center">新增餐桌</h1>
	<hr size="2px" align="center" color="#000000">
	<form align="center" action = "table_add.php" method = "POST">
	<h3>桌號編號:</h3>
	<?php
	$sql_check_pincipal = "SELECT `名字` FROM `employee`";
	$pincipal_result = mysqli_query($link,$sql_check_pincipal);
	echo "<input name = '桌號編號'>";
	echo "<h3>負責人:</h3>";
	echo "<select class='form-select' aria-label='Default select example' name = '負責人'>";
	if (mysqli_num_rows($pincipal_result)> 0) {
		while ($row_pincipal = mysqli_fetch_assoc($pincipal_result)) {
		echo "<option value='{$row_pincipal['名字']}'>{$row_pincipal['名字']}</option>";
		}
	}
	echo "</select>";
	?>
	<button>新增</button>
	</form>
	<a href="table_state.php"><input type="button" value="返回"></button></a>
	<?php
	 @ $table_number = $_POST['桌號編號'];
	 @ $pincipal_name = $_POST['負責人'];
	 $sql_check_table = "SELECT `桌號` FROM `diningtable` WHERE `桌號` = '{$table_number}'";
	 $sql_check_table_result = mysqli_query($link,$sql_check_table);
	 @ $insert_sql = "INSERT INTO `diningtable` (`ID`, `負責人`, `狀態`, `總金額`, `桌號`) VALUES (NULL,'{$pincipal_name}',
	'可使用','0','{$table_number}')";
	if(@ $table_number != null and mysqli_num_rows($sql_check_table_result) < 1){
		$insert_result = mysqli_query($link,$insert_sql);
		echo "<script language='JavaScript'>alert('新增成功');</script>";
	}
	else if(mysqli_num_rows($sql_check_table_result) >= 1){
		echo "<script language='JavaScript'>alert('新增失敗:此桌號已經有了');</script>";
	}
	?>
</body>
</html>
