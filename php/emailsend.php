<?php 

session_start();

if (strlen($_SESSION['login_userId'] <= 0)) {
    echo "<script>window.location.href='login.php'</script>";
}
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    function SendEmail($loginUserId, $userEmail, $bookAuthor, $bookTitle)
    {       
        //include 'libconfig.php';  

        $xml = GetServerInfo();

        /* Namespace alias. */
        require 'D:\Bitnami\php\composer\vendor\phpmailer\phpmailer\src\Exception.php';
        require 'D:\Bitnami\php\composer\vendor\phpmailer\phpmailer\src\PHPMailer.php';
        require 'D:\Bitnami\php\composer\vendor\phpmailer\phpmailer\src\SMTP.php';
    
        /* Include the Composer generated autoload.php file. */
        require 'D:\Bitnami\php\composer\vendor\autoload.php';

        $lSuccess = 0;
      
        /* Create a new PHPMailer object. Passing TRUE to the constructor enables exceptions. */
        $mail = new PHPMailer(TRUE);

        $mail->isSMTP();

        $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
        );

        /* Google (Gmail) SMTP server. */
        $mail->Host = $xml->Emailinfo->SMTPHost;

        /* SMTP port. */
        $mail->Port = $xml->Emailinfo->SMTPPort;

        $mail->SMTPDebug = 0;
        
        $mail->SMTPAuth = true;

        $mail->SMTPSecure = $xml->Emailinfo->SMTPProtocol;
        
        $mail->Username = $xml->Emailinfo->SMTPUsername;

        $mail->Password = $xml->Emailinfo->SMTPPassword;

        $errormsg = '';
    
        /* Open the try/catch block. */
        try {
            /* Set the mail sender. */
            $mail->setFrom($mail->Username, 'BookShare');

            /* Add a recipient. */
            $mail->addAddress($userEmail, 'User');
    
            /* Set the subject. */
            $mail->Subject = 'Book Request For '. $bookTitle .' Written By '. $bookAuthor;

            $loanerInfo = GetLoanerInfo($loginUserId);

            $text = '| Please contact - '. $loanerInfo['FirstName'] . ' ' . $loanerInfo['LastName'] . ' (Name) | ' . 
            $loanerInfo['Email'] . ' (Email) | ' . $loanerInfo['PhoneNumber'] . ' (Phonenumber)';
    
            /* Set the mail message body. */
            $mail->Body = $_POST['message'] . ' ' . $text;
    
            /* Finally send the mail. */
            
            $mail->send(); 

            $lSuccess = 1;
        }
    
        catch (Exception $e)
        {
            /* PHPMailer exception. */
            echo $e->errorMessage();
        }
        catch (\Exception $e)
        {
            /* PHP exception (note the backslash to select the global namespace Exception class). */
            echo $e->getMessage();
        }

        return $lSuccess;
    }

   
?>

<?php 
    include 'library.php';

    function GetLoanerInfo($loanerid)
    {
        $lconn = GetConnection();

        $lsql = "SELECT FirstName, LastName, Email, PhoneNumber FROM user WHERE UserId = ?";

        $lstmt = $lconn->prepare($lsql); 

        $lstmt->bind_param("d", $loanerid);
        
        $lstmt->execute();

        $result = $lstmt->get_result();
        
        $loanerInfo = $result->fetch_assoc();

        $result->free();

        $lstmt->close();

        $lconn->close();

        return $loanerInfo;
    }

    function GetUserEmail()
    {
        $lconn = GetConnection();
    
        if ($lconn->connect_errno) {
            echo "Failed to connect to MySQL: " . $lconn->connect_error; 
            exit(); 
        }
    
        $lsql = "SELECT Email FROM user WHERE UserId = ?";
    
        $lstmt = $lconn->prepare($lsql); 

        $UserId = $_POST['bookOwnerId'];
    
        $lstmt->bind_param('s', $UserId);
    
        $lstmt->execute();
    
        $result = $lstmt->get_result();
    
        $myrow = $result->fetch_row();

        return $myrow[0];
    }

    //main code

    session_start();

    if($_POST){
        if(isset($_POST['Borrow'])){
            //get book ownerid info
            //printf("bookid %s \n", $bookId);
            $bookId = $_POST['bookId'];
            $bookStatus = $_POST['status'];
        }
        if(isset($_POST['submit'])){
        if($_POST['submit'] == 'submitemail'){
            $loginUserId = $_SESSION['login_userId'];
            UpdateTransaction(2, $loginUserId);
            $bookAuthor = $_POST['author'];
            $bookTitle = $_POST['title'];
            $userEmail = GetUserEmail();
            if(SendEmail($loginUserId, $userEmail, $bookAuthor, $bookTitle) == 1) {
                echo '<script type="text/javascript">';
                echo 'alert("Email was successfully send")';  
                echo '</script>';
                echo "<script>window.location.href='../dashboard.html'</script>";
            }
        }
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Email Send</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/emailsend.css">
</head>

<body>

<header style="background-color: #0088ff;">
    <h1>Email Send</h1>
    
    <img src="../Images/logo.jpg" height="110" class="logo_move">

    <div class="BackDashboard">
        <a style="text-decoration:none;" href="dashboard.php">Dashboard</a>
    </div>
    
    <a style="text-decoration:none;" href="contactUs.php" class="contact">Contact Us</a>

    <a style="text-decoration:none;" href="#about" class="about">About Us</a>
</header> 

<p class="contactText">Please add any contact information, or any messages you want to send to the owner of the book</p>

<form action="emailsend.php" method="post">

<div class="messageBox">          
    <textarea cols="80" rows="30" name="message"></textarea>
</div>

<input type="hidden" name="bookId" value=<?php echo $_POST["bookId"]?>>

<input type="hidden" name="status" value=<?php echo $_POST["status"]?>>

<input type="hidden" name="statusId" value=<?php echo $_POST["statusId"]?>>

<input type="hidden" name="title" value=<?php echo $_POST["title"]?>>

<input type="hidden" name="author" value=<?php echo $_POST["author"]?>>

<input type="hidden" name="bookOwnerId" value=<?php echo $_POST["bookOwnerId"]?>>

<input type="hidden" name="submit" value="submitemail">

<button class="subbutton">Submit</button>

</form>

<form action="booksearch.php" method="post">
    <button class="canbutton">Cancel</button>
</form>

</body>
</html>