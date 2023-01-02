<?php
$host = '127.0.0.1:3307';
$user = 'root';
$password = '';
$dbName = 'cateringmanagement';

$link = new MySQLi($host,$user,$password,$dbName);

if($link->connect_error){
	die("連結失敗".$link->connect_error);
}
$sql_check_employee_name = "SELECT * FROM `employee`";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>經理資訊區-刪除員工資料</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://classless.de/classless.css">
</head>
<body>
	<h1 align="center" valign="center">經理資訊區-刪除員工資料</h1>
	<hr size="2px" align="center" color="#000000">
	<form align="center" action = "delete_employee.php" method = "POST">
	<h3>職員名稱:</h3>
	<select class='form-select' aria-label='Default select example' name = '職員名稱'>
	<?php
	$check_employee_result = mysqli_query($link,$sql_check_employee_name);
	if(mysqli_num_rows($check_employee_result ) > 0){
		while ($employee_row = mysqli_fetch_assoc($check_employee_result)) {
			echo "<option value='{$employee_row['名字']}'>{$employee_row['名字']}</option>";
		}
	}
	?>
	</select>
	<button>刪除</button>
	</form>
	<a href="employee_file.php"><input type="button" value="返回"></button></a>
	<?php
	@ $employee_name = $_POST['職員名稱'];
	@ $delete_employee = "DELETE FROM `employee` WHERE `名字` = '{$employee_name}'";
	if($employee_name != null){
		$delete_employee_result = mysqli_query($link,$delete_employee);
		echo "<script language='JavaScript'>alert('刪除成功');</script>";
		
	}
	?>
</body>
</html>