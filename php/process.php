<?php 

include 'config.php';

session_start();

function GetUserId($username)
{
    $lconn = GetConnection();

    $lstmt1 = $lconn->prepare("SELECT UserId FROM user WHERE Username=?");

    $lstmt1->bind_param("s", $username);

    $lstmt1->execute();

    $result = $lstmt1->get_result();
    
    $UserId = $result->fetch_row();

    $lstmt1->close();

    $lconn->close();

    return $UserId[0];
}

function ProcessUser($Username, $Password)
{
    $lSuccess = FALSE;

    $lconn = GetConnection();

    $lsql = "SELECT Username, Password, UserStatus FROM user WHERE Username = ?";

    $lstmt = $lconn->prepare($lsql); 

    $lstmt->bind_param('s', $Username);

    $lstmt->execute();

    $result = $lstmt->get_result();

    $myrow = $result->fetch_row();

    if($myrow[2] != '1') {
        echo '<script>alert("User not registered! Please click the register button to proceed")</script>';
        return $lSuccess;
    }

    if (password_verify($Password, $myrow[1])) {
        $lSuccess = TRUE;
    } 
    else {
        echo '<script>alert("Incorrect Password!")</script>';
    }

    $lstmt->close();
  
    $lconn->close(); 

    return $lSuccess;
}

//main code
$username = $_POST["username"]; 
$password = $_POST["password"];

$lSuccess = FALSE;

$_SESSION['error'] = '';

if((strlen($username) > 0) and (strlen($password) > 0)) {
   
    $_SESSION['username'] = $username;

    $lSuccess = ProcessUser($username, $password);

   if ($lSuccess == TRUE) {
      $_SESSION['login_user'] = $username;
      $_SESSION['login_userId'] = GetUserId($username);
      echo "<script>window.location.href='../dashboard.html'</script>";
   } 
   else {
      $_SESSION['error'] = 'incorrect user';
      echo "<script>window.location.href='../login.html'</script>";
   }
} else {
    
}
?>

