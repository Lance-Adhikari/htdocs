<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/register.css">
</head>

<body style="background-color:orange;">

<header style="background-color: #0088ff;">
    <h1>Update Password</h1>
    
    <img src="../Images/logo.jpg" height="110" class="logo_move">

    <div class="contact">
        <a style="text-decoration:none;" href="contactUs.php">Contact Us</a>
    </div>

    <div class="about">
        <a style="text-decoration:none;" href="#about">About Us</a>
    </div>
</header>

<img src="Images/logo.jpg" height="105" class="logo_move">

<form method="post">
    <div id="passinfo">
        <label>Enter a new password:</label>
        <input name="password" type="password" style="padding: 8px 5px;"><br>
        <label>Confirm your new password:</label>
        <input name="password2" type="password" style="padding: 8px 5px;"><br>
    </div>

    <input type="submit" id="updatePassword" value="Update Password">
</form>
</body>
</html>

<?php 

session_start();

if (strlen($_SESSION['login_userId'] <= 0)) {
    echo "<script>window.location.href='login.php'</script>";
}

function ValidateUserMsg($Id, $Token) 
{
    include 'library.php';

    // (F1) GET + CHECK THE USER
    $user = GetUserInfoById($Id);

    if ($user === false) {
      echo '<script type="text/javascript"> alert("User not found") </script>';  
      return false;
    }

    return true;
}

function UpdateNewPassword($NewPass) 
{
    include 'library.php';

    $lconn = GetConnection();

    # change this query to get a last generated token
    $lsql = "SELECT UserId, Token FROM changepassword WHERE UserId = ? order by CreateDate desc";

    $lstmt = $lconn->prepare($lsql); 

    $lstmt->bind_param("d",$_SESSION["userid"]); 

    $lstmt->execute();

    $result = $lstmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $luserId = $row["UserId"];
        $lToken = $row["Token"];
        break;
    }

    //printf("%d %d", $lToken, $_SESSION["token"]);

    if ($lToken != $_SESSION["token"]){
        echo '<script>alert("Corrupted link, Please try again!!")</script>';
        return False;
    }

    $result->free();

    $lstmt->close();

    #Update new password in a user table
    $lstmt = $lconn->prepare("UPDATE user SET Password = ? WHERE UserId = ?");

    $lEncryptedPW = password_hash($NewPass,PASSWORD_BCRYPT,array("cost"=>4));

    $lstmt->bind_param("ss",  $lEncryptedPW, $luserId);

    $lstmt->execute();

    $lstmt->close();

    $lconn->close();
 
    return true;
}

// MAIN PROGRAM
// add in session variable when GET
if($_SERVER['REQUEST_METHOD'] == "GET")
{
    if (ValidateUserMsg($_GET['i'], $_GET['h']) == TRUE){
        $_SESSION["userid"] = $_GET['i'];
        $_SESSION["token"]  = $_GET['h'];
    }
}

// Update new password when post
if( $_SERVER['REQUEST_METHOD'] == "POST") {
    
    $newPass1 = $_POST['password'];
    $newPass2 = $_POST['password2'];

    if ( (strlen($newPass1) > 0) and
         (strlen($newPass2) > 0) )
    {
        if ($newPass1 == $newPass2) {
            UpdateNewPassword($newPass1);
            echo "<script>window.location.href='../login.html'</script>";
        }
        else {
            echo '<script>alert("Password are not same")</script>';
        }
    }
    else {
        echo '<script>alert("Please enter a username or email!")</script>'; 
    }
    return;  
}

?>