<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php  use PHPMailer\PHPMailer\PHPMailer;
       require './vendor/autoload.php';
    //    $mail = new PHPMailer();
    //    echo get_class($mail);
?>
<?php
    if( !isset($_GET['forgot']) ) {
        redirect('index');
    }
    $message = '';
    if( ifItIsMethod('post') ) {
        if( isset( $_POST['email'] ) ) {
            $email = $_POST['email'];
            $length = 50;
            $token = bin2hex( openssl_random_pseudo_bytes( $length ) );

            if( is_email_exist($email) ) {

                if( $stmt = mysqli_prepare($connection, "UPDATE users SET user_token='{$token}' WHERE user_email = ?" ) ) {
                    mysqli_stmt_bind_param($stmt, "s", $email);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                    $message = "<h2>Please check your email</h2>";

                    /**
                     ** configure PhpMailer
                     */
                     $mail = new PHPMailer();
                    //  echo get_class($mail);

                    $mail->isSMTP();                                                    // Set mailer to use SMTP
                    $mail->Host       = Config::SMTP_HOST;                              // Specify main and backup SMTP servers
                    $mail->SMTPAuth   = true;                                           // Enable SMTP authentication
                    $mail->Username   = Config::SMTP_USER;                              // SMTP username
                    $mail->Password   = Config::SMTP_PASSWORD;                          // SMTP password
                    $mail->Port       = Config::SMTP_PORT;                              // TCP port to connect to
                    $mail->SMTPSecure = 'tls';                                          // Enable TLS encryption, `ssl` also accepted
                    $mail->SMTPAUTH = true;
                    
                    $mail->CharSet = 'UTF-8';
                    $mail->isHTML(true); 
                    $mail->setFrom('owaisibrahim099@gmail.com', 'Owais Ibrahim');
                    $mail->addAddress($email);

                    $mail->Subject = "This is test Email";
                    $mail->Body = "" .
                            "<p>Please click to reset your password<hr>" .
                                "<a href='http://localhost/cms/reset.php?email=".$email."&token=".$token."'>".
                                "http://localhost/cms/rest.php?email=".$email."&token=".$token."</a>" .
                            "</p>";

                    if( $mail->send() ) {
                        echo "IT WAS SENT";
                        $emailSent = true;
                    } else {
                        "NOT SENT";
                    }

                } else {
                    $message = mysqli_error($connection);
                }

            } else {
                $message = "Email Not Exist. Please <a href='/cms/register'>register</a> first or <a href='/cms/register'>login</a> to registered email<hr>";
            }
        }
    }
?>
<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                            <?php if( !isset( $emailSent ) ): ?>

                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">
                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->
                            <?php else: ?>
                                <?php echo $message ?>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->

