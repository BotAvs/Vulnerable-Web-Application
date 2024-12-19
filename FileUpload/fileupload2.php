<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="../Resources/hmbct.png" />
</head>
<body>

<div style="background-color:#c9c9c9;padding:15px;">
    <button type="button" name="homeButton" onclick="location.href='../homepage.html';">Home Page</button>
    <button type="button" name="mainButton" onclick="location.href='fileupl.html';">Main Page</button>
</div>

<div align="center">
<form action="" method="post" enctype="multipart/form-data">
    <br>
    <b>Select image : </b> 
    <input type="file" name="file" id="file" style="border: solid;">
    <input type="submit" value="Submit" name="submit">
</form>
</div>

<?php
if(isset($_POST["submit"])) {
    $target_dir = "uploads/";
    $original_filename = basename($_FILES["file"]["name"]);
    $target_file = $target_dir . uniqid() . '-' . $original_filename;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $type = $_FILES["file"]["type"];
	
    if (getimagesize($_FILES["file"]["tmp_name"]) === false) {
        echo "The file is not a valid image.";
        $uploadOk = 0;
    }

    if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
        echo "Only JPG, JPEG, PNG files are allowed.";
        $uploadOk = 0;
    }

    if($uploadOk == 1) {
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            echo "File uploaded to /uploads/" . htmlspecialchars($original_filename);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

</body>
</html>

