<?php
//if ((!isset($_SESSION)) || (!isset($_SESSION['admin']))) 
//{
  //header("Location: login.php");
//}
?>

<?php require('conn.php'); ?>

<?php
$date = '2023-07-03';
$sql = "SELECT * FROM milkdata WHERE d_ate = '$date' AND m_ilk < 10";
$result = $conn->query($sql);
$rows = array();

if ($result->num_rows > 0) {
    
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
}

$sql1 = "SELECT * FROM animal WHERE status!='Healthy'";
$result1 = $conn->query($sql1);
$rows1 = array();

if ($result1->num_rows > 0) {
    
    while ($row1 = $result1->fetch_assoc()) {
        $rows1[] = $row1;
    }
}
?>

<!DOCTYPE html>
<html>
  <head>
<title>Notification-Our Dairy</title>
<link rel="stylesheet" href="dashboardstyle.css">
<link rel="stylesheet" href="addanimalstyle.css">
<link rel="stylesheet" href="notificationstyle.css">
  </head>
  <body>
  <?php require('navbar.php'); ?>
  <br>
  <?php require('vnavbar.php'); ?>
  <br>
  <h1 class="headings">Notifications</h1>
<br>


    <section>
        <div class="row">
            <?php
            foreach ($rows as $row) {
               
            
                echo "<div class='col-sm-12'>
                       <div class='alert fade alert-simple alert-danger alert-dismissible text-left font__family-montserrat font__size-16 font__weight-light brk-library-rendered rendered show' role='alert' data-brk-library='component__alert'>
                      <strong class='font__weight-semibold'>Alert!</strong>Animal : ".$row['i_d']." has milk quantity ".$row['m_ilk']."kg.
                    </div>
                    </div>";
            }
           ?>
            <br><br>
            <?php
            foreach ($rows1 as $row1) {
              echo  "<div class='col-sm-12'>
                <div class='alert fade alert-simple alert-warning alert-dismissible text-left font__family-montserrat font__size-16 font__weight-light brk-library-rendered rendered show' role='alert' data-brk-library='component__alert'>
                  <strong class='font__weight-semibold'>Notification!</strong>Animal : ".$row1['id']." is sick.
                </div>
            </div>";
            }
            ?>
        </div>
    </section>
<br>
</body>
</html>