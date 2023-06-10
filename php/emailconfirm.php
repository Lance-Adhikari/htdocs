<?php

include 'library.php';

include 'libemail.php';

// (F) VERIFY REGISTRATION
function VerifyUserMsg($id, $hash) 
{
    try {

      if (strlen($id) <= 0) {
        throw new Exception('id not defined');
      }

      // (F1) GET + CHECK THE USER

      $user = GetUserInfoById($id);

      if ($user === false) {
        echo '<script type="text/javascript"> alert("User not found") </script>';  
        return false;
      }

      if ($user['UserStatus']=="1") {
        echo '<script type="text/javascript"> alert("Account is already activated") </script>';  
        return false;
      }

      if ($user['UserStatus']=="0") {
        echo '<script type="text/javascript"> alert("Account is suspended") </script>';  
        return false;
      }

      // (F2) HASH TOKEN CHECK
      if ($user['UserStatus'] != $hash) { 
          echo '<script type="text/javascript"> alert("Invalid Token") </script>'; 
        return false; 
      }  

      SetUserStatus($id, '1');
    } catch(Exeption $e) {
      echo 'Caught exception: ', $e->getMessage(), "\n";
      return false;
    } 

    return true;
}
    
$xml = GetServerInfo();

$url = $xml->Serverinfo->url;

$proto = $xml->Serverinfo->protocol;

$port = $xml->Serverinfo->port;

$lUrl = $proto."://".$url."/login.html";

if(strlen($port) > 0)
{
    $lUrl = $proto."://".$url.":".$port."/login.html";
}

#main code  
$lStatus = VerifyUserMsg($_GET['i'], $_GET['h']);

if ($lStatus == TRUE) { 
    $user = GetUserInfoById($_GET['i']);
    echo "Thank you, {$user['Username']}! Your account has been successfully activated. Click this link to login: <a href=".$lUrl.">Login to Bookexchange</a>"; 
}
else { 
    echo "Email verification was unsuccessfull.";
}

?>