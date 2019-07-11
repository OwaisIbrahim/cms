<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php  include "includes/nav.php"; ?>

<?php 

    if( !isset( $_GET['email'] ) && !isset( $_GET['token'] ) ) {
        redirect('index');
    }


    // $user_email = 'newuser@gmail.com';
    // $token = "f75018d981f0ffe1bed85f7662dd027d49b0416a2c26244ca11d34edc85ec5d9f0eab99e88c8b618b9d045c44a4eb1510f50";
    $email = $_GET['email'];    
    $token = $_GET['token'];

    if( $stmt = mysqli_prepare($connection, 'SELECT user_username, user_email, user_token FROM users WHERE user_token=?' ) ) {
        mysqli_stmt_bind_param($stmt, "s", $token);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $user_username, $user_email, $user_token);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        if( isset( $_POST['password'] ) && isset( $_POST['confirmPassword'] ) ) {
            if( $_POST['password'] === $_POST['confirmPassword'] ) {
                echo "CONFIRM PASSWORD";
                $password = $_POST['password'];
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT, array('cost'=>12));

                if( $stmt = mysqli_prepare($connection, "UPDATE users SET user_token='', user_password='{$hashedPassword}' WHERE user_email=?") ) {
                    mysqli_stmt_bind_param($stmt, "s", $email);
                    mysqli_stmt_execute($stmt);
                    if( mysqli_stmt_affected_rows($stmt) >= 1 ) {
                        redirect('/cms/login.php');
                    } else {
                        echo "ALL IS WELL";
                    }
                    mysqli_stmt_close($stmt);
                    $verified = true;

                } else {
                    echo "BAD QUERY";
                }
            } else {
                echo "PASSWORD MISMATCHED";
            }
        } else {
            echo "FIELD IS EMPTY";
        }
    } else {
        echo "QUERY ERROR";
    }
?>

<!-- Page Content -->
<div class="container">

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Reset Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">

                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="password" name="password" placeholder="Password" class="form-control"  type="password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="confirmPassword" name="confirmPassword" placeholder="Confirm password" class="form-control"  type="password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="resetPassword" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->

                               

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


   
    <hr>
    
    <?php include "includes/footer.php";?>

</div> <!-- /.container -->

