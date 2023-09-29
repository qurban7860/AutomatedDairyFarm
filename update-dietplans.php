<?php
//if ((!isset($_SESSION)) || (!isset($_SESSION['admin']))) 
//{
  //header("Location: login.php");
//}
?>

<?php require('conn.php');

$error = "";
$message = "";

if(isset($_REQUEST["updateDietPlans"])){
  $id = $_REQUEST["id"];
  $dietplan = $_REQUEST["dietplan"];
  $sdate = $_REQUEST["start"];
  $edate = $_REQUEST["end"];

  $sql = "UPDATE dietplans SET diet_plan = '$dietplan', s_date = '$sdate', e_date = '$edate' WHERE a_id = $id";
  
  if ($conn->query($sql) === TRUE) {
    $message = "Diet Plan Updated Successfully!";
  } else {
    $error = "Error In Updating Diet Plan!";
  }
}

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Diet Plans - Our Dairy</title>
    <link rel="stylesheet" href="dashboardstyle.css">
    <link rel="stylesheet" href="addanimalstyle.css">
  </head>
  <body>
    <?php require('navbar.php'); ?>
    <br>
    <?php require('vnavbar.php'); ?>
    <br>
    <h1 class="headings">Diet Plan</h1>
    <br>
    <?php
    if (isset($_GET['a_id'])) {
        $animalIdP = $_GET['a_id'];

        $sql = "SELECT* FROM dietplans WHERE a_id = '$animalIdP'";
        $result = mysqli_query($conn, $sql);
        $dietplan = mysqli_fetch_assoc($result);

        if ($dietplan) {
           echo "<div id='container1'>
           <form action='update-dietplans.php' method='POST'>
           <h2>Update Diet plan</h2>
           <input type='text' placeholder='Enter Animal ID' name='id' value=".$dietplan['a_id']." required/>
           <input type='text' placeholder='Enter Diet Plan' name='dietplan' value=".$dietplan['diet_plan']." required/>
           <input pattern='\d{4}-\d{2}-\d{2}' placeholder='Enter Start Date YYYY-MM-DD' name='start' value=".$dietplan['s_date']." required/>
           <input pattern='\d{4}-\d{2}-\d{2}' placeholder='Enter End Date YYYY-MM-DD' name='end' value=".$dietplan['e_date']." required/>
           <button name='updateDietPlans'>Update Diet Plan</button>
           <br>
           </form>
           </div>
           <br>";
        }
    }  
    ?>
     <span style='margin-left:20%;'><?php echo $error ?></span>
           <span style='margin-left:20%,color:green'><?php echo $message ?></span>
  </body>
</html>
