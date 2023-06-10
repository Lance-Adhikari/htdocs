<?php
session_start();

if (strlen($_SESSION['login_userId'] <= 0)) {
    echo "<script>window.location.href='php/login.php'</script>";
}

$target_dir = "Images/";

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  echo "Check if Post is successful";
  /* $check = getimagesize($target_file);
  var_dump($check);
  $imageFileType = strtolower($check["mime"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  } */
  $target_file = $target_dir.$_SESSION["login_userId"].'.jpg';
  move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
}

/*
// Check if file already exists
if (file_exists($target_dir . $target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "image/png") {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";

// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir)) {
    //echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
     //echo "<img src="$target_dir . $target_file" height=200 width=300 />";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
*/

?>

