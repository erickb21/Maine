<?php
// Database connexion
include "bdd/db_connect.php";

$target_dir = "img/uploads/";
$target_file = basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$targetFilePath = $target_dir . $target_file;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
/*         echo "File is an image - " . $check["mime"] . "."; */
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Désolé, l'image existe déjà.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Désolé, la taille de votre image est trop importante.";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Désolé, seul les fichiers JPG, JPEG, PNG et GIF sont acceptés.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 = error
if ($uploadOk == 0) {
    echo "Désolé, il y a eu un problème lors de l'importation de votre image.";

// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFilePath)) {
        $insert = $db->query("INSERT into images (ima_category, ima_title, ima_url, ima_date) VALUES ('1', '".$target_file."', '".$targetFilePath."', UNIX_TIMESTAMP())");
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>