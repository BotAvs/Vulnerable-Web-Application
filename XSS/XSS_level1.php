<!DOCTYPE html>
<html>
<head>
   <title>XSS 1</title>
   <link rel="shortcut icon" href="../Resources/hmbct.png" />
</head>
<body>
	
	 <div style="background-color:#c9c9c9;padding:15px;">
      <button type="button" name="homeButton" onclick="location.href='../homepage.html';">Home Page</button>
      <button type="button" name="mainButton" onclick="location.href='xssmainpage.html';">Main Page</button>
    </div>
    
    <div align="center">
       <form method="GET" action="" name="form">
          <p>Your name: <input type="text" name="username" required></p>
          <input type="submit" name="submit" value="Submit">
       </form>
    </div>

<?php
if (isset($_GET["username"])) {

    $username = htmlspecialchars($_GET["username"], ENT_QUOTES, 'UTF-8');
    echo("Your name is " . $username);
}
?>

</body>
</html>
