/*
//main
$target_dir = "../Images/";

$target_file = $target_dir.$_SESSION["login_userId"].'.jpg';

echo '<img src = "'.$target_file.'" height="100px" width="100px" />'; 

echo '

NEED TO TURN file_uploads = On IN PHP INI -->
<form action="account.php" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="fileToUpload" >
  <input type="submit" value="Upload Image" name="submit"> 
</form>

';

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    //$target_file = $target_dir.$_SESSION["login_userId"].'.jpg';
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    $imageFileType = strtolower($check["mime"]);

    if($check !== false) {
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
    } 
    
    else {
        echo "File is not an image.";
    } 
}
*/