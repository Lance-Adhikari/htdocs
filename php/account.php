<?php

session_start();
include 'library.php';

if (strlen($_SESSION['login_userId'] <= 0)) {
    echo "<script>window.location.href='login.php'</script>";
}

//main()
$uid = $_SESSION['login_userId'];
$user = GetUserInfoById($uid);
$fn = $user["FirstName"];
$ln = $user["LastName"];
$pn = $user["PhoneNumber"];
$em = $user["Email"];
$target_dir = "Images/";
$pic = $target_dir.$_SESSION["login_userId"].'.jpg';

echo '{"userid":' . "$uid" . ','.  
       '"firstName":'. "\"$fn\"" . ','.
       '"lastName":'. "\"$ln\"" . ','.
       '"phoneNumber":'. "$pn" . ','.
       '"email":'. "\"$em\"" . ','.
       '"picture":'. "\"$pic\"" .   
    '}';
?>        
