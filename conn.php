
	 <?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "ourdairy";
		
		// Create connection
		$conn = mysqli_connect($servername, $username, $password,$dbname);

		// Check connection
		if (!$conn) {
			die("Connection Error: " . mysqli_connect_error());
		}
		
	?>

