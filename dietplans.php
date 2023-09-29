<?php
//if ((!isset($_SESSION)) || (!isset($_SESSION['admin']))) 
//{
  //header("Location: login.php");
//}
?>

<?php require('conn.php'); ?>
<?php
$error = "";
$message = "";
if(isset($_REQUEST["addDietPlan"])){
  
  $id = $_REQUEST["id"];
  $dietplan = $_REQUEST["dietplan"];
  $sdate = $_REQUEST["start"];
  $edate = $_REQUEST["end"];

  $sql = "SELECT* FROM dietplans where a_id='$id'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
  $sql1 = "UPDATE dietplans SET diet_plan = '$dietplan', s_date = '$sdate', e_date = '$edate' WHERE a_id = $id";
  if ($conn->query($sql1) === TRUE) {
    $message = "Prevoius Diet Plan Updated Successfully!";
  } else {
    $error = "Error In Updating Diet Plan!";
  }
}
  else{
  $sql2 = "INSERT INTO dietplans (a_id, diet_plan, s_date, e_date) VALUES ('$id', '$dietplan', '$sdate', '$edate')";
  if ($conn->query($sql2) === TRUE) {
  $message = "Diet Plan Added Successfully!";}
  else{
    $error = "Error In Adding Diet Plan!";
  }
  }
}
?>

<!DOCTYPE html>
<html>
  <head>
<title>Diet Plans-Our Dairy</title>
<link rel="stylesheet" href="dashboardstyle.css">
<link rel="stylesheet" href="addanimalstyle.css">
  </head>
  <body>
  <?php require('navbar.php'); ?>
  <br>
  <?php require('vnavbar.php'); ?>
  <br>
  <h1 class="headings">Diet Plans</h1>
  <br>
  <div id="container1">
		<form action="dietplans.php" method="POST">
			<h2>Add diet plan</h2>
		
    	    <input type="text" placeholder="Enter Animal ID" name="id" required/>
		    <input type="text" placeholder="Enter Diet Plan" name="dietplan" required/>
            <input  pattern="\d{4}-\d{2}-\d{2}" placeholder="Enter Start Date YYYY-MM-DD"  name="start" required/>
			<input  pattern="\d{4}-\d{2}-\d{2}" placeholder="Enter End Date YYYY-MM-DD"  name="end" required/>
            <button name="addDietPlan">Add Diet Plan</button>
            <br>
			<span style='color:red'><?php echo $error ?></span>
            <span style='color:green'><?php echo $message ?></span>
		</form>
</div>
<br><br>
<h2 class="headings">Records</h2>
<br>
    <?php
    $error="";
    $sql1 = "SELECT a_id, diet_plan,s_date,e_date FROM dietplans";
    $result1 = mysqli_query($conn, $sql1);

    if (mysqli_num_rows($result1) > 0) {
    while($row = mysqli_fetch_assoc($result1)) {
    echo "<br><div style='background-color: lightgreen;width:40%;margin-left:20%' class=div1><h2>Animal ID: ".$row["a_id"]."</h2><br><h3>Diet Plan:</h3><h4>" .$row["diet_plan"]."</h4>";
    echo "<button onclick='updateDietPlan(" . $row['a_id'] . ")'>Update</button><button onclick='deleteDietPlan(" . $row["a_id"] . ")'>Delete</button> </div><br><br>";
  
  }
} else {
  $error="No Data currently available!";
}
    ?>
     
    <span style='background-color: red;margin-left:20%'><?php echo $error ?></span> <br>

    <script>
  function deleteDietPlan(a_id) {
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
      xhr.open("DELETE", "dietplans.php?a_id=" + a_id, true);
      xhr.send();
    }
  }
  function updateDietPlan(id) {
     window.location.href = "update-dietplans.php?a_id=" + id;
  }
  </script>

<!--Delete Animal-->
<?php
if (isset($_GET['a_id'])) {
  $dietplansa_Id = $_GET['a_id'];

  $sql = "DELETE FROM dietplans WHERE a_id = '$dietplansa_Id'";
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
</head>
</html>