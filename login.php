<?php require('conn.php'); ?>
<?php
	$error = "";
	$uname = "";
	if(isset($_POST["login"])){
		
		$uname = $_POST["username"];
		$pswd = $_POST["password"];
		
		$sql = "SELECT * FROM admin where username='$uname' and password='$pswd'";
		
	   $result = mysqli_query($conn, $sql);
	   
	   $recordsFound = mysqli_num_rows($result);
		  
	   if($recordsFound == 1)
	   {
		$row = mysqli_fetch_assoc($result); 
		
       // Start the session
        //session_start();
		//$_SESSION["admin"]=$uname;
		header('Location: dashboard.php');
	   }
	   else {
		 $error =  "Invalid username or password";
	   }
	  }
  ?>

<!DOCTYPE html>
<html>
  <head>
<title>Login-Our Dairy</title>
<link rel="stylesheet" href="loginstyle.css">
  </head>
  <body>

<div class="container" id="container">
	</div>
	<div class="form-container sign-in-container">
		<form action="login.php" method="POST">
			<h1>Login</h1>
			<input type="text" placeholder="Username" name="username" required/>
			<input type="password" placeholder="Password" name="password" required/>
			<button type="submit" name="login">Login</button>

			<span style='color:red'><?php echo $error ?></span>

		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-right">
        <h1>Welcome Back!</h1>
				<p>To keep connected with us please login with your personal info</p>
			
			</div>
		</div>
	</div>
</div>


    
</body>
</html>