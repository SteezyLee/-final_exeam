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
<title>經理資訊區-修改員工資料</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://classless.de/classless.css">
</head>
	<h1 align="center" valign="center">經理資訊區-修改員工資料</h1>
	<hr size="2px" align="center" color="#000000">
	<?php
	$sql_check_employee = "SELECT * FROM `employee`";
	$sql_check_employee_result = mysqli_query($link,$sql_check_employee);
	echo "<h3>職員名稱:</h3>";
	echo "<form align='center' action = 'update_employee.php' method = 'POST'>";
	echo "<select class='form-select' aria-label='Default select example' name = '職員名稱'>";
	if(mysqli_num_rows($sql_check_employee_result)> 0){
		while($employee_row = mysqli_fetch_assoc($sql_check_employee_result)){
			echo "<option value='{$employee_row['名字']}'>{$employee_row['名字']}</option>";	
		}
	}
	echo "</select>";
	echo "<button>查詢</button>";
	echo "</form>";
	?>
	<?php
	@ $confirm_employee = $_POST['職員名稱'];
	$employee_name = $confirm_employee;
	$sql_check_employee_information = "SELECT * FROM `employee` WHERE `名字` = '{$confirm_employee}'";
	$sql_check_employee_information_result = mysqli_query($link,$sql_check_employee_information);
	if($confirm_employee != null){
		echo "<h2 align='center' valign='center'>職員內容更新</h2>";
		echo "<form align='center' action = 'update_employee.php' method = 'POST'>";
		echo "<h3>目前要更改的職員: {$confirm_employee}</h3>";
		if(mysqli_num_rows($sql_check_employee_information_result)> 0){
			$employee_information_row = mysqli_fetch_assoc($sql_check_employee_information_result);
			echo "<h3>員工編號</h3>";
			echo "<input name = '員工編號' value = '{$employee_information_row['員工編號']}' required readonly>";
			echo "<h3>職位</h3>";
			echo "<select class='form-select' aria-label='Default select example' name = '職位'>";
			echo "<option value='{$employee_information_row['職位']}' selected>
			{$employee_information_row['職位']}</option>";
			echo "<option value='服務生'>服務生</option>";
			echo "<option value='廚師'>廚師</option>";
			echo "<option value='領檯人員'>領檯人員</option>";
			echo "<option value='經理'>經理</option>";
			echo "<option value='雜工'>雜工</option>";
		}
		echo "</select>";
		echo "<h3>薪資</h3>";
		echo "<input name = '薪資' value = '{$employee_information_row['薪資']}' required>";
		echo "<button>更新</button>";
		echo "</form>";
	}
	?>
	<?php
		@ $employee_position = $_POST['職位'];
		@ $emloyee_salary = $_POST['薪資'];
		@ $emloyee_number = $_POST['員工編號'];
		if($employee_position != null and $emloyee_salary != null){
		$sql_update_employee_information = "UPDATE `employee` SET `職位` = '{$employee_position}' ,
		`薪資` = '{$emloyee_salary}' WHERE `員工編號` = '{$emloyee_number}'";
		$update_employee_information_result = mysqli_query($link,$sql_update_employee_information);
		echo "<script language='JavaScript'>alert('修改成功');</script>";
		}
	?>
	<a href="employee_file.php"><input type="button" value="返回"></button></a>
<body>
</body>
</html>