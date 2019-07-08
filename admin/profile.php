<?php ob_start(); ?> <!-- REMOVE BUFFER CACHE IF PAGE RELOADS -->
<?php include "includes/admin_header.php" ?>


<?php 
    if( !isset($_SESSION['user_role']) ) {
        header("Location: ../index.php");
    } else {
        $user_id = $_SESSION['user_id'];
        
        $query = "SELECT * FROM users WHERE user_id={$user_id}";
        $select_user_by_id = mysqli_query($connection, $query);

        if(!$select_user_by_id) {
            die("QUERY FAILED: " . mysqli_error($connection));
        }
        while($row = mysqli_fetch_assoc($select_user_by_id)) {
            $s_user_id = $row['user_id'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_username = $row['user_username'];
            $user_role = $row['user_role'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_password = $row['user_password'];
        }

        
        if( isset($_POST['edit_user']) ) {
            $user_firstname = $_POST['user_firstname'];
            $user_lastname = $_POST['user_lastname'];
            $user_username = $_POST['user_username'];
            $user_email = $_POST['user_email'];
            $user_password = $_POST['user_password'];

            

            $query = "UPDATE users SET ";
            $query .= "user_firstname = '{$user_firstname}', ";
            $query .= "user_lastname = '{$user_lastname}', ";
            $query .= "user_username = '{$user_username}', ";
            $query .= "user_email = '{$user_email}', ";
            $query .= "user_password = '{$user_password}' ";
            $query .= "WHERE user_id={$s_user_id} ";

            $update_user_query = mysqli_query($connection, $query);

            confirm_query($update_user_query);
        }

    }
?>

<body>

    <div id="wrapper">

        <?php if($connection) echo "connection" ?>

        <!-- Navigation -->
        <?php include "includes/admin_nav.php" ?>
        
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        
                        <h1 class="page-header">
                            Welcome to Admin 
                            <small>Author</small>
                        </h1>

                        <form action="" method="post" enctype="multipart/form-data">    
                            <div class="form-group">
                                <label for="user_firstname">Firstname</label>
                                <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname ?>">
                            </div>
                            <div class="form-group">
                                <label for="user_lastname">Lastname</label>
                                <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname ?>">
                            </div>

                            <div class="form-group">
                                <label for="user_username">Username</label>
                                <input type="text" class="form-control" name="user_username"  value="<?php echo $user_username ?>">
                            </div>

                            <div class="form-group">
                                <label for="user_email">Email</label>
                                <input type="email" class="form-control" name="user_email" value="<?php echo $user_email ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="user_password">Password</label>
                                <input type="password"  class="form-control" autocomplete="off" name="user_password">
                            </div>
                            
                            

                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="edit_user" value="Update Profile">
                            </div>

                            </form>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
