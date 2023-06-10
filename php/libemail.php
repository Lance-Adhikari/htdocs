<?php 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    include_once 'libconfig.php';

    function SendEmailToUser($userEmail, $message, $subject)
    { 
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
            $mail->Subject = $subject;
    
            /* Set the mail message body. */
            $mail->Body = $message;

            printf("Check your email, and click on the new link. \n");

            /* Finally send the mail. */
            $mail->send();

            $lSuccess = 1;
        }
        catch (Exception $e)
        {
            /* PHPMailer exception. */
            printf("My error: %s\n", $e->errorMessage());
        }
        catch (\Exception $e)
        {
            /* PHP exception (note the backslash to select the global namespace Exception class). */
            printf("My error: %s\n",$e->getMessage());
        }
        return $lSuccess;
    }
?>