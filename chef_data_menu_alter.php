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
<title>修改餐點狀態</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://classless.de/classless.css">
</head>

<body>
	<h1 align="center" valign="center">修改餐點狀態</h1>
	<hr size="2px" align="center" color="#000000">
	<form align="center" action = "chef_data_menu_alter.php" method = "POST">
	<h3>餐點名稱:</h3>
	<select class="form-select" aria-label="Default select example" name = '餐點名稱'>
	<?php
	$sql_check_menu_number = "SELECT `餐點名稱`,`狀態` FROM `menu`";
	$menu_result = mysqli_query($link,$sql_check_menu_number);
	if (mysqli_num_rows($menu_result) > 0) {
		while ($row_menu = mysqli_fetch_assoc($menu_result)) {
		echo "<option value='{$row_menu['餐點名稱']}'>{$row_menu['餐點名稱']}</option>";
		}
	}
	echo "</select>";
	echo "<h3>狀態</h3>";
	echo "<select class='form-select' aria-label='Default select example' name = '狀態'>
		  <option>可販賣</option>
		  <option>已賣完</option>
		  </select>";
	?>
	<button>修改</button>
	</form>
	<a href="chef_data_menu.php"><input type="button" value="返回"></button></a>
	<?php
	 @ $menu_name = $_POST['餐點名稱'];
	 @ $menu_state = $_POST['狀態'];
	 @ $update_menu_state = "UPDATE `menu` SET `狀態` =  '{$menu_state}' 
	 						WHERE `餐點名稱` = '{$menu_name}'"; 
	 @ $update_result = mysqli_query($link,$update_menu_state);
	if(@ $menu_state != null){
		$update_state = mysqli_query($link,$update_menu_state);
		echo "<script language='JavaScript'>alert('修改成功');</script>";
	}
	?>
</body>
</html>


