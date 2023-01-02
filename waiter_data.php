<?php
$host = '127.0.0.1:3307';
$user = 'root';
$password = '';
$dbName = 'cateringmanagement';

$link = new MySQLi($host,$user,$password,$dbName);

if($link->connect_error){
	die("連結失敗".$link->connect_error);
}
$sum = 0;
/*sql語句區*/
$sql_check_table_number = "SELECT `桌號` FROM `diningtable` order by `桌號` asc";
$sql_check_table_state = "SELECT `狀態` FROM `diningtable` order by `桌號` asc";
$sql_check_order_number = "SELECT * FROM `order` order by `桌號` asc";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>服務生資訊</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://classless.de/classless.css">
</head>
<body>
	<style>.noLineBreak { display: inline; }</style>
	<h1 align="center" valign="center">服務生資訊區</h1>
	<hr size="2px" align="center" color="#000000">
	<div class="row">
  	<div class="col-4">
    <div id="list-example" class="list-group">
	<?php
	/*顯示桌號*/
	$table_result = mysqli_query($link,$sql_check_table_number);
	if (mysqli_num_rows($table_result)> 0) {
		while ($row = mysqli_fetch_assoc($table_result)) {
		$row = implode(" ",$row);
		echo "<a class='list-group-item list-group-item-action' href='#{$row}'>桌號{$row}</a>";
		}
	}
	mysqli_free_result($table_result);
	?>
	</div>
  	</div>
	<div class="col-8">
    <div data-bs-spy="scroll" data-bs-target="#list-example" data-bs-smooth-scroll="true" class="scrollspy-example" tabindex="0">
	<?php
	$table_result = mysqli_query($link,$sql_check_table_number);
	$table_state_result = mysqli_query($link,$sql_check_table_state);
	if (mysqli_num_rows($table_result)> 0 or mysqli_num_rows($table_state_result) > 0) {
        while ($row = mysqli_fetch_assoc($table_result)) {
			$row_state = implode(" ",mysqli_fetch_assoc($table_state_result));
			$row = implode(" ",$row);//數組轉字串。
			echo "<h4 id='{$row}'>桌號{$row}  狀態: {$row_state}</h4>";
			echo "<table class='table'>
  				  <thead class='table-dark'>
				  	<th>餐點</th>
					<th>數量</th>
					<th>金額</th>
					<th>狀態</th></thead>";
			$order_result = mysqli_query($link,$sql_check_order_number);
			if(mysqli_num_rows($order_result)>0){
				while($row_order = mysqli_fetch_assoc($order_result)){
					if($row_order['桌號'] == $row){
						echo "<tbody>
							  <td>{$row_order['餐點']}</td>
							  <td>{$row_order['數量']}</td>
							  <td>{$row_order['金額']}</td>
							  <td>{$row_order['狀態']}</td>";
						$sum = $sum + $row_order['金額']*$row_order['數量'];
					}
				}
				

				mysqli_free_result($order_result);
				
			}
		echo "</tbody></table>";
		echo "<h4 class = noLineBreak>總金額為:  </h4><u><h4 class = noLineBreak><font color='#FF0000'>{$sum}</font></h4></u>";
		$sql_update_table_sum = "UPDATE `diningtable` SET `總金額` = '{$sum}' WHERE `桌號` = '{$row}'";
		$sql_update_table_sum_result = mysqli_query($link,$sql_update_table_sum);
		$sum = 0;
       }
    }
	else{
		print("empty");
	}
	?>
	</div>
	<div class="btn-group-vertical" role="group" aria-label="Vertical button group" style="position: absolute; width:260px; right: -120px; top: 165px;" valign="center">
  	<a href="order_add.php"><button type="button" class="btn btn-dark">新增訂單</button></a>
  	<a href="order_delete.php"><button type="button" class="btn btn-dark">刪除訂單</button></a>
	<a href="chef_data_order_alter.php"><button type="button" class="btn btn-dark">修改訂單狀態</button></a>
	<a href="restaruant_system.php"><button type="button" class="btn btn-dark">登出</button></a>
	</div>
  </div>
</div>
</body>
</html>