<!DOCTYPE html>
<html>
<head>
    <title>Change Passowrd</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/changePass.css">
    <script>
        function flipUserInfo() {
            var ui = document.getElementById("userinfo");
            document.getElementById("getToken").style.display='none';

            ui.style.display='none';
        }
    </script>
</head>

<body>

<header style="background-color: #0088ff;">
    <h1>Forgot Password</h1>
    
    <img src="../Images/logo.jpg" height="110" class="logo_move">

    <div class="contact">
        <a style="text-decoration:none;" href="php/contactUs.php">Contact Us</a>
    </div>

    <div class="about">
        <a style="text-decoration:none;" href="#about">About Us</a>
    </div>
</header>

<img src="Images/logo.jpg" height="105" class="logo_move">
</body>

<form method="post">
    <fieldset class="logfieldset">

    <div class="UserName"> 
        <label id="username">Enter your username:</label>
        <input id="username" name="username" type="text" style="padding: 8px 5px;" font-size="22px;"><br>
    </div>
        
    <div class="UserInfo"> 
        <label id="useremail">Enter your email:</label>
        <input id="useremail" name="useremail" type="text" style="padding: 8px 5px;" font-size="22px;"><br>
    </div>

    </fieldset>

<input class="GetToken" type="submit" id="getToken" value="Get Token" onclick="flipUserInfo()">
</form>

<form action="../login.html" method="post">
    <p>
        <label class="loglabel">Go Back To Login Page</label>
        <button class="logbutton">Login</button>
    </p>
</form>

</body>
</html>

<?php

    function SendEmailPasswordUpdate($userid, $token, $email) 
    {
        include 'libemail.php'; 

        $xml = GetServerInfo();

        $url = $xml->Serverinfo->host;

        $protocol = $xml->Serverinfo->protocol;

        $lUrl = $proto."://".$url."/php/updatepassword.php"; 

        if(strlen($port) > 0)
        {
            $lUrl = $proto."://".$url.":".$port."/php/updatepassword.php";
        }
        
        $lSubject = 'Change password for book exchange app';
        $lMsg = sprintf(
        "Visit this <a href='%s?i=%u&h=%s'>link</a> to update your password.",
        $lUrl,$userid, $token);

        if (SendEmailToUser($email, $lMsg, $lSubject)==0){
            return false;
        }
    
        return true;
    }

    function SendEmailToChangePassword($Username, $Email)
    {
        include 'config.php';

        $lconn = GetConnection();

        $lsql = "SELECT UserId, Email FROM user WHERE Username = ? or Email = ?";

        $lstmt = $lconn->prepare($lsql); 

        $lstmt->bind_param("ss", $Username, $Email); 

        $lstmt->execute();

        $result = $lstmt->get_result();

        $luserId = NULL;

        $lemail = NULL;

        while ($row = $result->fetch_assoc()) {
            $luserId = $row["UserId"];
            $lemail = $row["Email"];
        }

        $ltoken = intval(rand(100000, 999999));

        $lDate = date('Y-m-d H:i:s');

        $result->free();

        $lstmt->close();

        $lstmt=$lconn->prepare("INSERT INTO changepassword VALUES (?, ?, ?, ?)");

        $lstmt->bind_param("dsds",  $luserId, $lemail, $ltoken, $lDate);

        $lstmt->execute();

        $lstmt->close();

        $lSubject = 'Change user password';

        $lMsg = sprintf("Please use this token, %d to change your password", $ltoken);

        if (SendEmailPasswordUpdate($luserId, $ltoken, $lemail)==0){
            return false;
        }

        $lconn->close();
    }

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        if((strlen($_POST['username']) > 0) or (strlen($_POST['useremail']) > 0)) {
            if (SendEmailToChangePassword($_POST['username'], $_POST['useremail'])) {
                echo '<script>alert("Please check email for 6 digit token!")</script>'; 
                return;
            } 
            else {
                echo '<script>alert("Email could not be sent!")</script>'; 
                return;
            }
        }
        else {
            echo '<script>alert("Please enter a username or email!")</script>'; 
            return;
        }
    }
    

?>