<?php
#creates new user id padded with date 
function GetNewUserId() 
{
    $lconn = GetConnection();
    
    # get last user id in the user table
    $lsql = "SELECT MAX(UserId) FROM user"; 

    $lstmt = $lconn->prepare($lsql); 
 
    $lstmt->execute();
 
    $lResult = $lstmt->get_result();

    $lMaxUserId = $lResult->fetch_row();

    $lstmt->close();

    $lId = str_pad(intval(substr($lMaxUserId[0], 6))+1, 4, "0", STR_PAD_LEFT); 

    $lNewId = date("Ym").$lId;

    return $lNewId;
}

#send email for user email verification.
function SendUserEmail($userid, $token, $email) 
{
    include 'libemail.php';
    
    $xml = GetServerInfo();

    $url = $xml->Serverinfo->url;

    $proto = $xml->Serverinfo->protocol;

    $port = $xml->Serverinfo->port;

    if(strlen($port) > 0)
    {
        $lUrl = $proto."://".$url.":".$port."/php/emailconfirm.php";
    }
    else {
        $lUrl = $proto."://".$url."/php/emailconfirm.php";
    }
    $lSubject = 'Email verification for Bookexchange app';
    $lMsg = sprintf(
      "Click this link %s?i=%u&h=%s to complete your registration.",
      $lUrl,$userid, $token );

    if (SendEmailToUser($email, $lMsg, $lSubject)==0){
        return false;
    }
  
    return true;
}

#insert user information in the user database
function CreateNewUser($Password, $Username, $Email, $PhoneNumber, $LastName, $FirstName) 
{
    include_once('config.php');

    $lConn = GetConnection();

    $lNewUserId = GetNewUserId();

    $lAddress = NULL;

    // (E3) GENERATE NOT-SO-RANDOM TOKEN HASH FOR VERIFICATION
    $lToken = md5(date("YmdHis") . $Email);

    $lDate = date('Y-m-d H:i:s');

    $lStmt=$lConn->prepare("INSERT INTO user (UserId,CreateDate,FirstName,LastName,PhoneNumber,Email,Username,UserStatus,
                          Password,AddressId) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $lStmt->bind_param("dsssdssssd",  $lNewUserId, $lDate, $FirstName, $LastName, $PhoneNumber,
                                      $Email, $Username, $lToken, $Password, $lAddress);

    $lStmt->execute();

    $lStmt->close();

    $lConn->close();

    if (SendUserEmail($lNewUserId, $lToken, $Email) == false) 
    {
        echo '<script>alert("Failed to send an email!!")</script>';
    }
    else {
        echo '<script>alert("Email successfully sent!")</script>';
    }
}

function ValidateUsername($Username)
    {
        $lrc = 0; 

        if (ctype_alpha(substr($Username, 0, 1))) {
            $lrc = 1;
    } 
        
    return $lrc;
}

# main program - triggered when Register button is clicked.
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    if((strlen($_POST['username']) > 0) and (strlen($_POST['password']) > 0)) {
        if (ValidateUsername($_POST['username']) == 0) {
            echo '<script>alert("Username cannot have a number as a first letter")</script>';
            //header("Location: {$_SERVER["HTTP_REFERER"]}");
            echo "<script>window.location.href='../register.html'</script>";  
            return;
        }

        if ($_POST['password'] != $_POST['password2']) {
            echo '<script>alert("Password does not match")</script>';
            echo "<script>window.location.href='../register.html'</script>"; 
            //header("Location: {$_SERVER["HTTP_REFERER"]}");
        }
        else{
            $options = array("cost"=>4);
            $hashPassword = password_hash($_POST['password'],PASSWORD_BCRYPT,$options);
            CreateNewUser($hashPassword, $_POST['username'], $_POST['email'], $_POST['phoneNumber'], $_POST['lastName'], $_POST['firstName']);
        }
    }
    else {
        if (array_key_exists('firstName', $_POST)) {
            echo '<script>alert("Please enter the all the fields")</script>';
        }
    }
}
?>
