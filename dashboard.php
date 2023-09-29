<?php
//if ((!isset($_SESSION)) || (!isset($_SESSION["admin"]))) 
//{
  //header("Location: login.php");
//}

require('conn.php'); ?>

<?php
    $date = "2023-07-03";

    // Daily Milk
    $sql1 = "SELECT SUM(m_ilk) AS dmilk FROM milkdata WHERE d_ate = '$date'";
    $result1 = mysqli_query($conn, $sql1);
    
    if ($result1) {
        $row1 = mysqli_fetch_assoc($result1);
        $dailyMilk = $row1['dmilk'];
    }

    // Weekly Milk
    $sql2 = "SELECT SUM(m_ilk) AS w_milk FROM milkdata WHERE YEARWEEK(d_ate) = YEARWEEK('$date')";
    $result2 = mysqli_query($conn, $sql2);

    if ($result2) {
    $row2 = mysqli_fetch_assoc($result2);
    $weeklyMilk = $row2['w_milk'];
   }


   // Monthly Milk
   $sql3 = "SELECT SUM(m_ilk) AS m_milk FROM milkdata WHERE YEAR(d_ate) = YEAR('$date') AND MONTH(d_ate) = MONTH('$date')";
    $result3 = mysqli_query($conn, $sql3);

    if ($result3) {
      $row3 = mysqli_fetch_assoc($result3);
      $monthlyMilk = $row3['m_milk'];
    }


    // Annualy Milk
    $sql4 = "SELECT SUM(m_ilk) AS a_milk FROM milkdata WHERE YEAR(d_ate) = YEAR('$date')";
    $result4 = mysqli_query($conn, $sql4);

    if ($result4) {
      $row4 = mysqli_fetch_assoc($result4);
      $annualyMilk = $row4['a_milk'];
    } 
    ?>

<?php
    // Total Animal
    $sql5 = "SELECT COUNT(*) AS total_rows FROM animal";
    $result5 = mysqli_query($conn, $sql5);
    
    if ($result5) {
        $row5 = mysqli_fetch_assoc($result5);
        $total = $row5['total_rows'];
    }

    // Healthy Animal
    $sql6 = "SELECT COUNT(*) AS h_count FROM animal WHERE status = 'healthy' OR status = 'Healthy'";
    $result6 = mysqli_query($conn, $sql6);

    if ($result6) {
    $row6 = mysqli_fetch_assoc($result6);
    $healthy = $row6['h_count'];
   }


   // Sick Animals
   $sql7 = "SELECT COUNT(*) AS s_count FROM animal WHERE status NOT IN ('healthy', 'Healthy')";
    $result7 = mysqli_query($conn, $sql7);

    if ($result7) {
    $row7 = mysqli_fetch_assoc($result7);
    $sick = $row7['s_count'];
   }



    // Pregnant Animal
    $sql8 = "SELECT COUNT(*) AS p_count FROM animal WHERE pregnant = 1";
    $result8 = mysqli_query($conn, $sql8);

    if ($result8) {
      $row8 = mysqli_fetch_assoc($result8);
      $pregnant = $row8['p_count'];
    } 
    ?>


<!DOCTYPE html>
<html>
  <head>
<title>Dashboard-Our Dairy</title>
<link rel="stylesheet" href="dashboardstyle.css">
</head>
<body>
  
  <?php require('navbar.php'); ?>
  <br>
  <?php require('vnavbar.php'); ?>

  <br>
  <h1 class="headings">Milk Production</h1>
<br>
<div id="daily" class="mproduction">
<h3>Daily</h3>
<br>
<h2 id="daily1"></h2>
<h3><?php echo $dailyMilk ?> ltr</h3>
</div>

<div id="weekly" class="mproduction">
<h3>Weekly</h3>
<br>
<h2 id="weekly1"></h2>
<h3><?php echo $weeklyMilk ?> ltr</h3>
</div>

<div id="monthly" class="mproduction">
<h3>Monthly</h3>
<br>
<h2 id="monthly1"></h2>
<h3><?php echo $monthlyMilk ?> ltr</h3>
</div>
<div id="annualy" class="mproduction">
<h3>Annualy</h3>
<br>
<h2 id="annualy1"></h2>
<h3><?php echo $annualyMilk ?> ltr</h3>
</div>
<br><br><br>

<h1 class="headings">Cows</h1>
<div id="total" style="margin-left: 20%" class="mproduction">
<h3>Total</h3>
<br>
<h2 id="total1"></h2>
<h3><?php echo $total ?> </h3>
</div>

<div id="healthy" style="margin-left: 8%" class="mproduction">
<h3>Healthy</h3>
<br>
<h2 id="healthy1"></h2>
<h3><?php echo $healthy ?> </h3>
</div>

<div id="sick" style="margin-left: 8%" class="mproduction">
<h3>Sick</h3>
<br>
<h2 id="sick1"></h2>
<h3><?php echo  $sick ?> </h3>
</div>
<div id="pregnant" style="margin-left: 8%" class="mproduction">
<h3>Pregnant</h3>
<br>
<h2 id="pregnant1"></h2>
<h3><?php echo $pregnant ?> </h3>
</div>
<br><br><br>

<h1 class="headings">Cows List</h1>

    <?php
    $error=""; 
    $sql = "SELECT id, breed, price, temperature,status,milk,mtemp,mgroup FROM animal";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
    echo "<div style='background-color: lightgreen;width:40%;margin-left:20%' class=div1>
          <h2>ID: ".$row["id"]."</h2><br>
          <h3>Breed: ".$row["breed"]."</h3><br>
          <h3>Temperature: " .$row["temperature"]."</h3>
          <button onclick='moreDetails(" . $row["id"] . ")'>More Details</button>
          <button onclick='updateAnimal(" . $row["id"] . ")'>Update</button>
          <button onclick='deleteAnimal(" . $row["id"] . ")'>Delete</button> 
        </div><br><br>";
  }
} 
else {
  $error="No Data currently available!";
}
    ?>
    <span style='background-color: red;margin-left:20%'><?php echo $error ?></span> 
    <script>
  function deleteAnimal(id) {
    if (confirm("Are you sure you want to delete this animal?")) {
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            window.location.reload();
          } else {
            console.error("Deletion failed: " + xhr.responseText);
          }
        }
      };
      xhr.open("DELETE", "dashboard.php?id=" + id, true);
      xhr.send();
    }
  }

  
  function updateAnimal(id) {

    window.location.href = "update-animal.php?id=" + id;
  }


  function moreDetails(id) {

    window.location.href = "moredetails.php?id=" + id;
  }
</script>

<!--Delete Animal-->
<?php
$conn = mysqli_connect("localhost", "root", "", "ourdairy");
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
if (isset($_GET['id'])) {
  $animalId = $_GET['id'];

  $sql = "DELETE FROM animal WHERE id = '$animalId'";
  if (mysqli_query($conn, $sql)) {
    
    echo "Deletion Successful";
    exit;
  } else {
    echo "Deletion failed: " . mysqli_error($conn);
  }
} 
mysqli_close($conn);
?>
  </body>
</html>