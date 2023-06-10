
<?php
session_start();

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
//main
    $target_dir = "../Images/";

    $target_file = $target_dir.$_SESSION["login_userId"].'.jpg';
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    $imageFileType = strtolower($check["mime"]);

    if($check !== false) {
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        echo "<script>
                alert('File successfully uploaded'); 
                window.history.go(-1);
               </script>";
    }
    else {
        echo "<script>
        alert('File is not an image'); 
        window.history.go(-1);
       </script>";
    } 
}
?>