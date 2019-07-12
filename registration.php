<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php  //include "includes/nav.php"; ?>
<?php 
    //Setting Language Variable
    if( isset( $_GET['lang'] ) && !empty($_GET['lang']) ) {

        $_SESSION['lang'] = $_GET['lang'];

        if( isset($_SESSION['lang']) && $_SESSION['lang'] != $_GET['lang'] ) {
            echo "<script type='text/javascript'> location.reload(); </script>";
        }
    }
    if( isset( $_SESSION['lang'] ) ) {
        include "includes/languages/" . $_SESSION['lang'] . ".php";
    } else {
        include "includes/languages/en.php";
    }
?>
<?php //PUSHER NOTIFICATION - Section42
    require "vendor/autoload.php";
   
    $dotenv = Dotenv\Dotenv::create(__DIR__, '.env');
    $dotenv->load();

    $options = array(
        'cluster' => 'ap2',
        'useTLS' => true
      );
    $pusher = new Pusher\Pusher(getenv('APP_KEY'), getenv('APP_SECRET'), getenv('APP_ID'), $options);
?>
    
    <?php //AUTHENTICATION
        // if( isset($_POST['register']) )
        if( $_SERVER['REQUEST_METHOD'] == 'POST' )
        {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            $error = [
                'username' => '',
                'email' => '',
                'password' => ''
            ];
            if( strlen($username) == '' ) {
                $error['username'] = "Username cannot be empty";
            } elseif( strlen($username) < 4 ) {
                $error['username'] = "Username needs to be longer";
            } elseif( is_user_exist($username) ) {
                $error['username'] = "Username already exist, pick another";
            }
            

            if( strlen($email) == '' ) {
                $error['email'] = "Username cannot be empty";
            } elseif( is_email_exist($email) ) {
                $error['email'] = "Email already exist,<a href='index.php'>Please Login</a>";
            }

            if( $password == '' ) {
                $error['password'] = "Password cannot be empty";
            }

            foreach( $error as $key => $value ) {
                if(empty($value)) {
                    unset( $error[$key] );
                    // register_user($username, $email, $password);
                    // login_user($username, $password);
                }
            } //foreach

            if( empty($error) ) {
                register_user($username, $email, $password);
                $data['message'] = $username;
                $pusher->trigger('notifications', 'new_user', $data);
                login_user($username, $password);

            }

        } else {
            $message = "";
        }
    ?>
 
    <!-- Page Content -->
<div class="container">
    
    <form method="get" class="navbar-form navbar-right" action=""  id="language_form">
        <div class="form-group">
            <select name="lang" class="form-control" onchange="changeLanguage()">
                <option value="en"
                    <?php if( isset($_SESSION['lang']) && $_SESSION['lang']=='en' ) { echo "selected"; } ?>
                >English</option>
                <option value="es"
                    <?php if( isset($_SESSION['lang']) && $_SESSION['lang']=='es' ) { echo "selected"; } ?>
                >Spanish</option>
            </select>
        </div>
    </form>

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                    <h1> <?php echo _REGISTER; ?> </h1>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <div class="form-group">
                                <label for="username" class="sr-only" >username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="<?php echo _USERNAME; ?>" 
                                    autocomplete="on" 
                                    value="<?php echo isset($username) ? $username : ''  ?>"
                                >
                                <p> <?php echo isset($error['username']) ? $error['username'] : ''  ?> </p>
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="<?php echo _EMAIL; ?>" 
                                    autocomplete="on" 
                                    value="<?php echo isset($email) ? $email : ''  ?>"
                                >
                                <p> <?php echo isset($error['email']) ? $error['email'] : ''  ?> </p>

                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control" placeholder="<?php echo _PASSWORD; ?>" 
                                    value="<?php echo isset($password) ? $password : ''  ?>"
                                >
                                <p> <?php echo isset($error['password']) ? $error['password'] : ''  ?> </p>

                            </div>
                    
                            <input type="submit" name="register" id="btn-login" class="btn btn-primary btn-lg btn-block" value="<?php echo _REGISTER; ?>">
                        </form>
                    
                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>
    <hr>

<?php include "includes/footer.php";?>
</div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script>
        function changeLanguage() {
            document.getElementById('language_form').submit();
        }
    </script>

</body>

</html>

