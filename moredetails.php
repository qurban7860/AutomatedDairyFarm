<?php
//if ((!isset($_SESSION)) || (!isset($_SESSION['admin']))) 
//{
  //header("Location: login.php");
//}
?>

<?php require('conn.php'); ?>

<!DOCTYPE html>
<html>
  <head>
<title>Details-Our Dairy</title>
<link rel="stylesheet" href="dashboardstyle.css">
  </head>
  <body>
  <?php require('navbar.php'); ?>
  <br>
  <?php require('vnavbar.php'); ?>
  <br>
  <h1 class="headings">Animal Details</h1>
<br>

<?php
if (isset($_GET['id'])) {
  $animalIdP = $_GET['id'];
   


  $sql = "SELECT* FROM animal WHERE id = '$animalIdP'";
  $result = mysqli_query($conn, $sql);
  $animal = mysqli_fetch_assoc($result);

  if ($animal) {
    $id = $animal['id'];
    $breed = $animal['breed'];
    $price = $animal['price'];
    $temp = $animal['temperature'];
    $status = $animal['status'];
    $mtemp = $animal['mtemp'];
    $mgroup = $animal['mgroup'];
    $pregnant = $animal['pregnant'];
  }


    $date = "2023-07-03";
    
    // Daily Milk
    $sql1 = "SELECT m_ilk FROM milkdata WHERE d_ate = '$date' and i_d='$animalIdP'";
    $result1 = mysqli_query($conn, $sql1);
    
    if ($result1) {
        $row1 = mysqli_fetch_assoc($result1);
        $dailyMilk = $row1['m_ilk'];
    }

    // Weekly Milk
    $sql2 = "SELECT SUM(m_ilk) AS w_milk FROM milkdata WHERE YEARWEEK(d_ate) = YEARWEEK('$date') and i_d='$animalIdP' ";
    $result2 = mysqli_query($conn, $sql2);

    if ($result2) {
    $row2 = mysqli_fetch_assoc($result2);
    $weekly = $row2['w_milk'];
   }


   // Monthly Milk
   $sql3 = "SELECT SUM(m_ilk) AS m_milk FROM milkdata WHERE YEAR(d_ate) = YEAR('$date') AND MONTH(d_ate) = MONTH('$date') and i_d='$animalIdP' ";
    $result3 = mysqli_query($conn, $sql3);

    if ($result3) {
      $row3 = mysqli_fetch_assoc($result3);
      $monthly = $row3['m_milk'];
    }


    // Annualy Milk
    $sql4 = "SELECT SUM(m_ilk) AS a_milk FROM milkdata WHERE YEAR(d_ate) = YEAR('$date') and i_d='$animalIdP'";
    $result4 = mysqli_query($conn, $sql4);

    if ($result4) {
      $row4 = mysqli_fetch_assoc($result4);
      $annualy = $row4['a_milk'];
    }
    
    
    $wmilk = array();
    $count1 = 0;
    $weekStart = date('Y-m-d', strtotime('-4 weeks'));
    
    $sql1 = "SELECT WEEK(d_ate) AS week_number, SUM(m_ilk) AS total_milk
        FROM milkdata
        WHERE i_d='$animalIdP' and d_ate >= '{$weekStart}'
        GROUP BY week_number
        ORDER BY week_number ASC";
    $result1 = mysqli_query($conn, $sql1);
    
    while ($row = mysqli_fetch_assoc($result1)) {
      $wmilk[$count1]["label"] = $row["week_number"];
      $wmilk[$count1]["y"] = $row["total_milk"];
      $count1++;
    }
   
    echo "<script>
      window.onload = function() {
	      var chartline = new CanvasJS.Chart('chartContainerline', {
	      title: {
		    text: 'Weekly Milk'
       	}, 
        axisY: {
		    title: 'Milk in (KG)'},
	      data: [{
		    type: 'line',
		    dataPoints: ";
        ?>
        <?php echo json_encode($wmilk, JSON_NUMERIC_CHECK);?>
        <?php
        echo "
      	}]
       });
       chartline.render();
       }
	     </script>
    
    ";

    echo"
    <br><br>
    <h2 style='margin-left:20%'class='headings'>Animal ID:".$animalIdP."</h2>
    <div>
    <br>
    <div  id='daily' class='mproduction'>
    <h3>Daily</h3>
    <br>
    <h2 id='daily1'></h2>
    <h3>".$dailyMilk." ltr</h3>
    </div>
    
    <div id='weekly' class='mproduction'>
    <h3>Weekly</h3>
    <br>
    <h2 id='weekly1'></h2>
    <h3>".$weekly." ltr</h3>
    </div>
    
    <div id='monthly' class='mproduction'>
    <h3>Monthly</h3>
    <br>
    <h2 id='monthly1'></h2>
    <h3>".$monthly."ltr</h3>
    </div>
    <div id='annualy' class='mproduction'>
    <h3>Annualy</h3>
    <br>
    <h2 id='annualy1'></h2>
    <h3>".$annualy."ltr</h3>
    </div>
    </div>
    <br><br><br>
    
    <div>
    <div style='margin-left:20%' id='health' class='mproduction'>
    <h3>Health Status</h3>
    <br>
    <h2 id='health1'></h2>
    <h3>".$status."</h3>
    </div>
    
    <div style='margin-left:8%' id='breed' class='mproduction'>
    <h3>Breed</h3>
    <br>
    <h2 id='breed1'></h2>
    <h3>".$breed."</h3>
    </div>
    
    <div style='margin-left:8%' id='temp' class='mproduction'>
    <h3>Temperature</h3>
    <br>
    <h2 id='temp1'></h2>
    <h3>".$temp."C</h3>
    </div>
    <div style='margin-left:8%' id='mroup1' class='mproduction'>
    <h3>Milk Group</h3>
    <br>
    <h2 id='mgroup1'></h2>
    <h3>".$mgroup."</h3>
    </div>
    </div>
    <br><br><br>";
  }
    ?>

<h1 class="headings">Chart</h1>
      <br>
	  <div id="chartContainerline" style="height: 370px; width: 80%;margin-left:20%"></div>
	  <br><br>
      <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</html>