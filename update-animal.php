<?php
//if ((!isset($_SESSION)) || (!isset($_SESSION['admin']))) 
//{
  //header("Location: login.php");
//}
?>

<?php require('conn.php');?>

<?php
$error = "";
$message = "";
if(isset($_REQUEST["updateAnimal"])){
  $i_d = $_REQUEST["animal_id"];
  $breed = $_REQUEST["breed"];
  $price = $_REQUEST["price"];
  $temp = $_REQUEST["temperature"];
  $status = $_REQUEST["status"];
  $mtemp = $_REQUEST["m_t"];
  $milk = $_REQUEST["milk"];
  $pregnant = isset($_POST['pregnant']) ? 1 : 0;
  
  $m_d=(int)$milk;
  $m_g="";
  if($m_d<10){
    $m_g="G0";
  }
  elseif($m_d>=10&&$m_d<=25){
    $m_g="G1";
  }
  elseif($m_d>25&&$m_d<=35){
    $m_g="G2";
  }
  else
  {
    $m_g="G3";
  }

  $sql1 = "UPDATE animal SET breed = '$breed', price = '$price', temperature='$temp', status='$status', milk='$milk', mtemp='$mtemp', mgroup='$m_g', pregnant='$pregnant'  WHERE id = '$i_d'";
  
  if ($conn->query($sql1) === TRUE) {
     $message = "Animal Updated Successfully!";
  }
  else {
   $error = "Error In Updating Animal!";
   }
  }
?>

<!DOCTYPE html>
<html>
  <head>
<title>Update Animal-Our Dairy</title>
<link rel="stylesheet" href="dashboardstyle.css">
<link rel="stylesheet" href="addanimalstyle.css">
  </head>
  <body>
  <?php require('navbar.php'); ?>
  <br>
  <?php require('vnavbar.php'); ?>
  <br>
  <h1 class="headings">Upadte Animal</h1>
<br>
<?php
if (isset($_GET['id'])) {
  $animalIdP = $_GET['id'];

  $sql = "SELECT id, breed, price, temperature, status, milk, mtemp, mgroup FROM animal WHERE id = '$animalIdP'";
  $result = mysqli_query($conn, $sql);
  $animal = mysqli_fetch_assoc($result);

  if ($animal) {

          echo "<div id='container1'>
          <form action='update-animal.php' method='POST'>
            <h2>Update animal record</h2>
            <input type='text' name='animal_id' value='" . $animal['id'] . "' >
            <input type='text' placeholder='Enter Breed' name='breed' value='" . $animal['breed'] . "' required/>
            <input type='text' placeholder='Enter Price' name='price' value='" . $animal['price'] . "' required/>
            <input type='text' placeholder='Enter Temperature' name='temperature' value='" . $animal['temperature'] . "' required/>
            <input type='text' placeholder='Enter Health Status' name='status' value='" . $animal['status'] . "' required/>
            <input type='text' placeholder='Enter Milk Production' name='milk' value='" . $animal['milk'] . "' required/>
            <input type='text' placeholder='Enter Milk Temperature' name='m_t' value='" . $animal['mtemp'] . "' required/>
            <div class='radio-group'>
              <input type='radio' name='pregnant' required id='pregnant-radio-1' value='1'>
              <label for='pregnant-radio-1'>Pregnant!</label>
            </div>
            <div class='radio-group'>
              <input type='radio' name='pregnant' required id='pregnant-radio-0' value='0'>
              <label for='pregnant-radio-0'>Not Pregnant!</label>
            </div>
            <button type='submit' name='updateAnimal'>Update</button>
            
            </form><br>";
  } else {
    echo "Animal not found!";
  }
  

}
?>
<span style='color:red;margin-left:20%'><?php echo $error ?></span>
<span style='color:green;margin-left:20%'><?php echo $message ?></span>
</body>
</html>