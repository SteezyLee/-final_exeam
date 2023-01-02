<?php
$host = '127.0.0.1:3307';
$user = 'root';
$password = '';
$dbName = 'cateringmanagement';

$link = new MySQLi($host,$user,$password,$dbName);

if($link->connect_error){
	die("連結失敗".$link->connect_error);
}
$check = false;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>創建員工</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://classless.de/classless.css">
</head>
<body>
<h1 align="center" valign="center">創建員工</h1>
<hr size="2px" align="center" color="#000000">
<form align="center" action = "add_employee.php" method = "POST">
<h3>名字:</h3>
<input name = '名字'>
<h3>員工編號:</h3>
<input name = '員工編號'>
<h3>職位:</h3>
<select class='form-select' aria-label='Default select example' name = '職位'>
<option value='服務生'>服務生</option>
<option value='廚師'>廚師</option>
<option value='領檯人員'>領檯人員</option>
<option value='雜工'>雜工</option>
<option value='經理'>經理</option>
<select/>
<h3>入職時間:</h3>
<input type="date" name = '入職時間'>
<h3>薪資:</h3>
<input name = '薪資'>
<button name="createButton">創建</button>
<div></div>
</form>
<?php
 if(isset($_POST['createButton'])){
@ $name = $_POST['名字'];
@ $employee_number = $_POST['員工編號'];
@ $position = $_POST['職位'];
@ $entry_Time = $_POST['入職時間'];
@ $salary = $_POST['薪資'];
$sql_create_employee = "INSERT INTO `employee` (`員工編號`, `名字`, `職位`, `入職時間`, `薪資`) VALUES ('{$employee_number}','{$name}','{$position}','{$entry_Time}','{$salary}')";
$sql_check_employee_name = "SELECT * FROM `employee` WHERE `名字` = '{$name}'";
$sql_check_employee_number = "SELECT * FROM `employee` WHERE `員工編號` = '{$employee_number}'";
$sql_check_employee_name_result = mysqli_query($link,$sql_check_employee_name);
$sql_check_employee_number_result = mysqli_query($link,$sql_check_employee_number);
if(mysqli_num_rows($sql_check_employee_name_result) < 1 and mysqli_num_rows($sql_check_employee_number_result) < 1 and $name != null and $employee_number != null and $entry_Time != null and $salary > 0){
	$create_employee_add = mysqli_query($link,$sql_create_employee);
	echo "<script language='JavaScript'>alert('創建成功');</script>";
}
else if($name == null or $employee_number == null or $entry_Time == null or $salary < 0 or null){
	echo "<script language='JavaScript'>alert('創建失敗:有資料未填寫或薪資為負數');</script>";
}
else if(mysqli_num_rows($sql_check_employee_name_result) > 0 or mysqli_num_rows($sql_check_employee_number_result) > 0){
	echo "<script language='JavaScript'>alert('創建失敗:已有此編號或已有此名字');</script>";
}
}
?>
<a href="employee_file.php"><input type="button" value="返回"></a>
</body>
</html>