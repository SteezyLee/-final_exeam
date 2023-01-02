<?php
//此地確認資料是否有誤和確認是否是自己想要的資料。
/*
if (mysqli_num_rows($result)>0) {
        while ($row = mysqli_fetch_assoc($result)) {
			echo implode(" ",$row);//數組轉字串。
        }
    }
else{
	print("empty");
}
*/
/*
if($result){
	$employee_data = mysqli_fetch_assoc($result);
	echo $employee_data;
}
*/

/*
$data = $res -> fetch_all();


var_dump($data);
*/
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>高師餐飲管理系統</title>
<link rel="stylesheet" href="https://classless.de/classless.css">
</head>
<body>
<?php
$host = '127.0.0.1:3307';
$user = 'root';
$password = '';
$dbName = 'cateringmanagement';

$link = new MySQLi($host,$user,$password,$dbName);

if($link->connect_error){
	die("連結失敗".$link->connect_error);
}
/*post 資料進php*/
@ $employee_number = $_POST["職員編號"];
if(isset($_POST["log_in"])){
/*進sql查這位職員的職位*/
$sql_check_employee_number = "SELECT `職位` FROM `employee` where `員工編號` = '{$employee_number}'";
/*執行sql語法*/
$result = mysqli_query($link,$sql_check_employee_number);
/*如果有讀取資料去判斷其編號的職位*/
if(mysqli_num_rows($result) >= 1){
	$row = mysqli_fetch_assoc($result);
	echo implode(" ",$row);

	if(implode(" ",$row)== '服務生'){
		header('Location: waiter_data.php');
	}
	if(implode(" ",$row)== '廚師'){
		header('Location: chef_data.php');
	}
	if(implode(" ",$row)== '雜工'){
		header('Location: handyman_data.php');
	}
	if(implode(" ",$row)== '經理'){
		header('Location: manager_data.php');
	}
	if(implode(" ",$row)== '領檯人員'){
		header('Location: frount_data.php');
	}
}
	else{
		echo "<script language='JavaScript'>alert('沒有此職員或未輸入!');parent.location.href= 'restaruant_system.php';</script>";
	}
}
?>
</body>
</html>