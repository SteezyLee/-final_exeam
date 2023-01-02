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
<title>經理資訊區-人員檔案</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://classless.de/classless.css">
</head>
<body>
	<h1 align="center" valign="center">經理資訊區-人員檔案</h1>
	<hr size="2px" align="center" color="#000000">
	<div class="row">
  	<div class="col-4">
    <div id="list-example" class="list-group">
	<div class="btn-group-vertical" role="group" aria-label="Vertical button group" style="position: absolute; width:260px; right: -120px; top: 165px;" valign="center">
  	<a href="add_employee.php"><button type="button" class="btn btn-dark">創建員工</button></a>
  	<a href="delete_employee.php"><button type="button" class="btn btn-dark">刪除員工</button></a>
	<a href="update_employee.php"><button type="button" class="btn btn-dark">修改員工資料</button></a>
	<a href="manager_data.php"><button type="button" class="btn btn-dark">返回經理資訊區</button></a>
	</div>
	<?php
	$sql_check_employee = "SELECT * FROM `employee`";
	$sql_check_employee_result = mysqli_query($link,$sql_check_employee);
	if (mysqli_num_rows($sql_check_employee_result) > 0) {
		while ($row = mysqli_fetch_assoc($sql_check_employee_result)) {
		echo "<a class='list-group-item list-group-item-action' href='#{$row['名字']}'>員工:{$row['名字']}</a>";
		}
	}
	mysqli_free_result($sql_check_employee_result);
	?>
	</div>
  	</div>
	<div class='col-8'>
	<div data-bs-spy='scroll' data-bs-target='#list-example' data-bs-smooth-scroll='true' class='scrollspy-example' tabindex='0'>
	<table class='table'>
  	<thead class='table-dark'>
	<th>員工編號</th>
	<th>名字</th>
	<th>職位</th>
	<th>入職時間</th>
	<th>薪資</th></thead>
	<?php
	$sql_check_employee_result = mysqli_query($link,$sql_check_employee);
	if(mysqli_num_rows($sql_check_employee_result)> 0){
		while($row = mysqli_fetch_assoc($sql_check_employee_result)){
			echo "<tbody>
			<td>{$row['員工編號']}</td>
			<td>{$row['名字']}</td>
			<td>{$row['職位']}</td>
			<td>{$row['入職時間']}</td>
			<td>{$row['薪資']}</td>";
		}
	}
	?>
	</tbody></table>
	</div>
	</div>
	</div>
</body>
</html>