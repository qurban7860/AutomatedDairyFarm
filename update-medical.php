<?php
//if ((!isset($_SESSION)) || (!isset($_SESSION['admin']))) 
//{
  //header("Location: login.php");
//}
?>

<?php
require('conn.php');

$error = "";
$message = "";

if(isset($_REQUEST["updateMedicalRecord"])){
  $id = $_REQUEST["id"];
  $condition = $_REQUEST["condition"];
  $treat = $_REQUEST["treatment"];
  $sdate = $_REQUEST["start"];
  $edate = $_REQUEST["end"];
  $mid = $_REQUEST["mid"];

  $sql1 = "UPDATE medicalrecords SET a_id = '$id',m_condition='$condition', s_date = '$sdate', e_date = '$edate' WHERE m_id = '$mid'";
  
  if ($conn->query($sql1) === TRUE) {
    $message = "Medical Record Updated Successfully!";
  } else {
    $error = "Error In Updating Medical Record!";
  }
}

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Update Medical Record - Our Dairy</title>
    <link rel="stylesheet" href="dashboardstyle.css">
    <link rel="stylesheet" href="addanimalstyle.css">
  </head>
  <body>
    <?php require('navbar.php'); ?>
    <br>
    <?php require('vnavbar.php'); ?>
    <br>
    <h1 class="headings">Update Medical Record</h1>
    <br>
    <?php
    if (isset($_GET['m_id'])) {
        $medical = $_GET['m_id'];

        $sql = "SELECT* FROM medicalrecords WHERE m_id = '$medical'";
        $result = mysqli_query($conn, $sql);
        $medicalR = mysqli_fetch_assoc($result);

        if ($medicalR) {
           echo "<div id='container1'>
           <form action='update-medical.php' method='POST'>
           <h2>Update Diet plan</h2>
           <input type='text' placeholder='Enter Animal ID' name='id' value=".$medicalR['a_id']." required/>
           <input type='text' placeholder='Enter Medical Condition' name='condition' value=".$medicalR['m_condition']." required/>
           <input type='text' placeholder='Enter Medical Condition' name='treatment' value=".$medicalR['treatment']." required/>
           <input pattern='\d{4}-\d{2}-\d{2}' placeholder='Enter Start Date YYYY-MM-DD' name='start' value=".$medicalR['s_date']." required/>
           <input pattern='\d{4}-\d{2}-\d{2}' placeholder='Enter End Date YYYY-MM-DD' name='end' value=".$medicalR['e_date']." required/>
           <input type='hidden' name='mid' value=".$medicalR['m_id'].">
           <button name='updateMedicalRecord'>Update Medical Record</button>
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