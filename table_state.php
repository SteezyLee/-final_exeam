<?php
$host = '127.0.0.1:3307';
$user = 'root';
$password = '';
$dbName = 'cateringmanagement';

$link = new MySQLi($host,$user,$password,$dbName);

if($link->connect_error){
	die("連結失敗".$link->connect_error);
}
$check_table = "SELECT * FROM `diningtable`";
$check_table_result = mysqli_query($link,$check_table);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>餐桌狀態</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://classless.de/classless.css">
</head>
<body>
	<h1 align="center" valign="center">經理資訊區-餐桌狀態</h1>
	<hr size="2px" align="center" color="#000000">
	<div class="btn-group-vertical" role="group" aria-label="Vertical button group" style="position: absolute; width:260px; right: -120px; top: 165px;" valign="center">
  	<a href="table_add.php"><button type="button" class="btn btn-dark">增加餐桌</button></a>
  	<a href="table_delete.php"><button type="button" class="btn btn-dark">刪除餐桌</button></a>
	<a href="principal_update.php"><button type="button" class="btn btn-dark">修改負責人</button></a>
	<a href="manager_data.php"><button type="button" class="btn btn-dark">返回經理資訊區</button></a>
	</div>
	<?php
		echo "<div class='row'>";
  		echo "<div class='col-4'><div id='list-example' class='list-group'>";
	if(mysqli_num_rows($check_table_result) > 0){
		while($row_table = mysqli_fetch_assoc($check_table_result)){
		echo "<a class='list-group-item list-group-item-action' href='#{$row_table['桌號']}'>桌號: {$row_table['桌號']}</a>";
		}
	}
	echo "</div>
		  </div>";
	mysqli_free_result($check_table_result);
	$check_table_result = mysqli_query($link,$check_table);
	echo "<div class='col-8'>";
	echo "<div data-bs-spy='scroll' data-bs-target='#list-example' data-bs-smooth-scroll='true' class='scrollspy-example' tabindex='0'>";
	if(mysqli_num_rows($check_table_result) > 0){
		while($row_table = mysqli_fetch_assoc($check_table_result)){
		echo "<h4 id='{$row_table['桌號']}'>桌號: {$row_table['桌號']}</h4>";
		echo "<table class='table'>
			  <thead class='table-dark'>
			  <th>負責人</th>
			  <th>餐桌狀態</th>
			  <th>目前顧客總金額</th>
			  </thead>
			  <tbody>
			  <td>{$row_table['負責人']}</td>
			  <td>{$row_table['狀態']}</td>
			  <td>{$row_table['總金額']}</td>
			  </tbody>
			  </table>";
		}
	}
	echo "</div>";
	echo "</div>";
	echo "</div>";
	?>
</body>
</html>
