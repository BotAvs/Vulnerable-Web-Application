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

if (isset($_POST["submit"])) {
    $target_dir = "uploads/";
    $original_filename = basename($_FILES["file"]["name"]);
    
    // Crear un nombre único para evitar sobrescritura de archivos
    $unique_filename = uniqid() . '-' . $original_filename;
    $target_file = $target_dir . $unique_filename;
    
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["file"]["tmp_name"]);

    // Validación del tipo de archivo
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    } else {
        // Solo permitir imágenes con los tipos MIME especificados
        if ($check["mime"] != "image/png" && $check["mime"] != "image/jpeg" && $check["mime"] != "image/gif") {
            echo "Only JPG, PNG, and GIF files are allowed.";
            $uploadOk = 0;
        }
    }

    // Limitar el tamaño del archivo (ejemplo: 5MB)
    if ($_FILES["file"]["size"] > 5 * 1024 * 1024) {
        echo "Sorry, your file is too large. Maximum allowed size is 5MB.";
        $uploadOk = 0;
    }

    // Validar la extensión del archivo
    if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
        echo "Only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Si todo es correcto, intentar mover el archivo
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            echo "File uploaded successfully: " . htmlspecialchars($unique_filename);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

</body>
</html>
