<?php
$host = '127.0.0.1:3307';
$user = 'root';
$password = '';
$dbName = 'cateringmanagement';

$link = new MySQLi($host,$user,$password,$dbName);

if($link->connect_error){
	die("連結失敗".$link->connect_error);
}

$sql_check_menu = "SELECT * FROM `menu` order by `餐點名稱` asc";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>廚師資訊</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://classless.de/classless.css">
</head>
<body>
	<style>.noLineBreak { display: inline; }</style>
	<h1 align="center" valign="center">廚師資訊區-菜單資訊</h1>
	<hr size="2px" align="center" color="#000000">
	<div class="row">
  	<div class="col-3">
    <div id="list-example" class="list-group">
	<?php
	$menu_result = mysqli_query($link,$sql_check_menu);
	if (mysqli_num_rows($menu_result)> 0) {
		while ($row = mysqli_fetch_assoc($menu_result)) {
		$menu_name = $row['餐點名稱'];
		echo "<a class='list-group-item list-group-item-action' href='#{$menu_name}'>{$menu_name}</a>";
		}
	}
	?>
	</div>
	</div>
	<div class="col-9">
    <div data-bs-spy="scroll" data-bs-target="#list-example" data-bs-smooth-scroll="true" class="scrollspy-example" tabindex="0" >
	<table class='table'>
  	<thead class='table-dark'>
		<th>餐點名稱</th>
		<th>食材</th>
		<th>金額</th>
		<th>狀態</th></thead>
	<?php
	$menu_result = mysqli_query($link,$sql_check_menu);
	if (mysqli_num_rows($menu_result)> 0){
		while ($row_menu = mysqli_fetch_assoc($menu_result)){
			echo "<tbody>
				  <td>{$row_menu['餐點名稱']}</td>
				  <td>{$row_menu['食材']}</td>
				  <td>{$row_menu['金額']}</td>
				  <td>{$row_menu['狀態']}</td>";
		}

	}
	mysqli_free_result($menu_result);
	echo "</tbody></table>";
	?>
	<div class="btn-group-vertical" role="group" aria-label="Vertical button group" style="position: absolute; width:260px; right: -300px; top: 200px;" valign="center">
	
	<a href="chef_data_menu_alter.php"><button type="button" class="btn btn-dark">修改餐點狀態</button></a>
	<a href="chef_data.php"><button type="button" class="btn btn-dark">返回訂單資訊</button></a>

	</div>
	</div>
	</div>
	</div>
</body>
</html>