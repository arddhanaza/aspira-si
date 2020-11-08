<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings    
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'nurhidaylma@gmail.com';                     // SMTP username
    $mail->Password   = 'J@j4ngmyeon';                               // SMTP password
    $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('nurhidaylma@gmail.com', 'ilmanurhidayati');
    $mail->addAddress('nurhidaylma@gmail.com');     // Add a recipien    
    $mail->addReplyTo('no-replye@gmail.com', 'No Reply');    

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">                
        <div class="row">                                                                     
            <div class="col-md-6 left-side ">                              
                <div class="row ">
                    <div class="col ">
                        <h3>ASPIRA <br> -SI</h3>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 ">
                        <form>
                            <div class="form-group">
                                <label for="nim">NIM</label>
                                <input type="text" class="form-control shadow p-1 mb-1 bg-white rounded" id="nim" name="inputNim" >                        
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control shadow p-1 mb-1 bg-white rounded" id="password" name="inputPassword">
                            </div>                    
                            <button type="submit" class="btn btn-primary btn-block">LOGIN</button>                            
                        </form>                
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 align-items-end">
                        <a href="forgot_password.php">Forgot Password</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <img src="../../assets/img/icon.png" alt="coba">
            </div>
        </div>
    </div>
</body>
</html>