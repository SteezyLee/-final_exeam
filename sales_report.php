<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>經理資訊區-銷售報表</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://classless.de/classless.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
	<h1 align="center" valign="center">經理資訊區-銷售報表</h1>
	<hr size="2px" align="center" color="#000000">
	<h3>今日單品銷售量:(持續更新)</h3>
	<div>
  	<canvas id="今日單品銷售量"></canvas>
	</div>
	<h3>每日營收、成本、淨利:</h3>
	<div>
  	<canvas id="每日營收、成本、淨利"></canvas>
	</div>
	<h3>每天均消費:</h3>
	<div>
  	<canvas id="每天均消費"></canvas>
	</div>
	<h3>每日翻桌率:</h3>
	<div>
  	<canvas id="每日翻桌率"></canvas>
	</div>
	<a href="manager_data.php"><input type="button" value="返回"></button></a>
</body>
<script>
  	const Single_product_sales = document.getElementById('今日單品銷售量');
	const daily_cost = document.getElementById('每日營收、成本、淨利');
	const Average_consumption_per_day = document.getElementById('每天均消費');
	const Daily_table_turnover_rate = document.getElementById('每日翻桌率');
  	new Chart(Single_product_sales, {
    	type: 'bar',
    	data: {
      	labels: ['白醬雞肉義大利麵', '番茄海鮮義大利麵', '豬排白醬義大利麵', '壽喜燒火鍋', '培根蛋吐司', '番茄培根義大利麵'],
       	datasets: [{
        label: '銷售量',
        data: [10, 12, 5, 6, 7, 5],
        borderWidth: 1
      	}]
    	},
    	options: {
      	scales: {
        	y: {
          	beginAtZero: true
        	}
      	}
    	}
	});
		
	new Chart(daily_cost, {
    	data: {
      	labels: ['2022/12/5', '2022/12/6', '2022/12/7', '2022/12/8', '2022/12/9', '2022/12/10','2022/12/11'],
       	datasets: [{
		type: 'line',
        label: '每日營收',
        data: [32560, 34020, 22300, 33200, 45620, 36800,35690],
        borderWidth: 1
      	},
		{
		type: 'line',
        label: '每日成本',
        data: [12560, 12300, 8200, 12100, 18840, 18000,20820],
        borderWidth: 1
      	},
		{
		type: 'line',
        label: '每日淨利',
        data: [20000, 21720, 14100, 21100, 21780, 18800,14870],
        borderWidth: 1
      	}]
    	},
    	options: {
      	scales: {
        	y: {
          	beginAtZero: true
        	}
      	}
    	}
	});
	
	new Chart(Average_consumption_per_day, {
    	type: 'bar',
    	data: {
      	labels: ['2022/12/5', '2022/12/6', '2022/12/7', '2022/12/8', '2022/12/9', '2022/12/10','2022/12/11'],
       	datasets: [{
        label: '每天平均消費',
        data: [420,560,400,460,480,350,380],
        borderWidth: 1
      	}]
    	},
    	options: {
      	scales: {
        	y: {
          	beginAtZero: true
        	}
      	}
    	}
	});
	
	new Chart(Daily_table_turnover_rate, {
    	type: 'line',
    	data: {
      	labels: ['2022/12/5', '2022/12/6', '2022/12/7', '2022/12/8', '2022/12/9', '2022/12/10','2022/12/11'],
       	datasets: [{
        label: '每日翻桌率',
        data: [12.8,10.1,9.3,12,11.6,17.5,15.6,],
        borderWidth: 1
      	}]
    	},
    	options: {
      	scales: {
        	y: {
          	beginAtZero: true
        	}
      	}
    	}
	});
	</script>
</html>
