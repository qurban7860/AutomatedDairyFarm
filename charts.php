<?php
//if ((!isset($_SESSION)) || (!isset($_SESSION['admin']))) 
//{
  //header("Location: login.php");
//}
?>

<?php require('conn.php'); ?>

<?php 
$date="2023-07-03";

$dailymilk=array();
$count=0;

$sql = "SELECT * FROM milkdata where d_ate='$date'";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_array($result)){
  $dailymilk[$count]["label"]=$row["i_d"];
  $dailymilk[$count]["y"]=$row["m_ilk"];
  $count++;
}
?>

<?php
 $wmilk = array();
 $count1 = 0;
 $weekStart = date('Y-m-d', strtotime('-4 weeks'));
 
 $sql1 = "SELECT WEEK(d_ate) AS week_number, SUM(m_ilk) AS total_milk
		 FROM milkdata
		 WHERE d_ate >= '{$weekStart}'
		 GROUP BY week_number
		 ORDER BY week_number ASC";
 $result1 = mysqli_query($conn, $sql1);
 
 while ($row = mysqli_fetch_assoc($result1)) {
	 $wmilk[$count1]["label"] = $row["week_number"];
	 $wmilk[$count1]["y"] = $row["total_milk"];
	 $count1++;
 }
?>

<!DOCTYPE html>
<html>
  <head>
      <title>Charts-Our Dairy</title>
      <link rel="stylesheet" href="dashboardstyle.css">
      <link rel="stylesheet" href="addanimalstyle.css">
    
	<script>
      window.onload = function() {
      var chart = new CanvasJS.Chart("chartContainer", {
	  animationEnabled: true,
	  theme: "light2",
	  title:{
		text: "Daily Milk"
	  },
	  axisY: {
		title: "Milk (in KG)"
	  },
	  axisX: {
		title: "Animal ID"
	},
	  data: [{
		type: "column",
		yValueFormatString: "#,##0.## tonnes",
		dataPoints: <?php echo json_encode($dailymilk, JSON_NUMERIC_CHECK); ?>
    	}]
      });

	var chartline = new CanvasJS.Chart("chartContainerline", {
	title: {
		text: "Weekly Milk"
	},
	axisY: {
		title: "Milk in (KG)"
	},
	axisX: {
		title: "Week Number"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($wmilk, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();

chartline.render();
}
	</script>
	</head>
    <body>
      <?php require('navbar.php'); ?>
      <br>
      <?php require('vnavbar.php'); ?>
      <br>
      <h1 class="headings">Charts</h1>
      <br>
      <div id="chartContainer" style="height: 370px; width: 80%;margin-left:20%"></div>
	  <br><br>
	  <div id="chartContainerline" style="height: 370px; width: 80%;margin-left:20%"></div>
	  <br><br>
      <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    </body>
</html>                              