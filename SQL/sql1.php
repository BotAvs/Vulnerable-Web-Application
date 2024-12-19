<!DOCTYPE html>
<html>
<head>
	<title>SQL Injection</title>
	<link rel="shortcut icon" href="../Resources/hmbct.png" />
</head>
<body>

	<div style="background-color:#c9c9c9;padding:15px;">
      <button type="button" name="homeButton" onclick="location.href='../homepage.html';">Home Page</button>
      <button type="button" name="mainButton" onclick="location.href='sqlmainpage.html';">Main Page</button>
	</div>

	<div align="center">
	<form action="process_form.php" method="post">
		<p>John -> Doe</p>
		First name : <input type="text" name="firstname">
		<input type="submit" name="submit" value="Submit">
	</form>
	</div>


<?php 
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db = "1ccb8097d0e9ce9f154608be60224c7c";

	
	$conn = mysqli_connect($servername, $username, $password, $db);

	if (!$conn) {
    	die("Connection failed: " . mysqli_connect_error());
	} 
	
	if(isset($_POST["submit"])) {
		$firstname = $_POST["firstname"];

		
		if (!empty($firstname) && preg_match("/^[a-zA-Z ]*$/", $firstname)) {
			
			$stmt = $conn->prepare("SELECT lastname FROM users WHERE firstname=?");
			$stmt->bind_param("s", $firstname);

			$stmt->execute();
			$result = $stmt->get_result();

			if (mysqli_num_rows($result) > 0) {
        		
				while($row = mysqli_fetch_assoc($result)) {
        			echo htmlspecialchars($row["lastname"]);
        			echo "<br>";
				}
			} else {
        		echo "0 results";
			}
			$stmt->close(); 
		} else {
			echo "Invalid input. Only letters and spaces are allowed.";
		}
	}


	mysqli_close($conn);
?>
</body>
</html>

