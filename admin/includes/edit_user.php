
<?php 

    if( isset( $_GET['edit_user'] ) ) {
        $the_user_id = $_GET['edit_user'];
        
        $query = "SELECT * FROM users WHERE user_id={$the_user_id}";
        $all_users = mysqli_query($connection, $query);
        while( $row = mysqli_fetch_assoc($all_users) ) {
            $user_id = $row['user_id'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            
            $user_username = $row['user_username'];
            $user_role = $row['user_role'];
            $user_email = $row['user_email'];
            $user_password = $row['user_password'];
        }

        if( isset($_POST['edit_user']) ) {
            $user_firstname = $_POST['user_firstname'];
            $user_lastname = $_POST['user_lastname'];
            $user_role = $_POST['user_role'];
            $user_username = $_POST['user_username'];
            $user_email = $_POST['user_email'];
            $user_password = $_POST['user_password'];

            
            if( !empty($user_password) ) {
                $query_password = "SELECT user_password FROM users WHERE user_id=$the_user_id";
                $get_user_query = mysqli_query($connection, $query_password);
                confirm_query($get_user_query);

                $row = mysqli_fetch_array($get_user_query);

                $db_user_password = $row['user_password'];

                if( $db_user_password != $user_password ) {
                    $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
                } else {
                    $hashed_password = $user_password;
                }

                $query = "UPDATE users SET ";
                $query .= "user_firstname = '{$user_firstname}', ";
                $query .= "user_lastname = '{$user_lastname}', ";
                $query .= "user_role = '{$user_role}', ";
                $query .= "user_username = '{$user_username}', ";
                $query .= "user_email = '{$user_email}', ";
                $query .= "user_password = '{$hashed_password}' ";
                $query .= "WHERE user_id={$the_user_id} ";

                $update_user_query = mysqli_query($connection, $query);

                confirm_query($update_user_query);

                
                echo "User Updated <a href='users.php'>View Users?</a>";
            }

            



        }
    } else {
        header("Location: index.php");
    }
    
?>

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
    <select name="user_role" id="">
            <option value="<?php echo $user_role ?>"><?php echo $user_role ?></option>
            <?php 
                if( $user_role == 'admin' ) {
                    echo "<option value='subscriber'>Subscriber</option>";
                } else {
                    echo "<option value='admin'>Admin</option>";
                }
            ?>
            
        
    </select>
 </div>

  <div class="form-group">
     <label for="user_username">Username</label>
      <input type="text" class="form-control" name="user_username"  value="<?php echo $user_username ?>">
  </div>

  
  
<!-- <div class="form-group">
     <label for="post_image">Post Image</label>
      <input type="file"  name="image">
  </div> -->

  <div class="form-group">
     <label for="user_email">Email</label>
      <input type="email" class="form-control" name="user_email" value="<?php echo $user_email ?>">
  </div>
  
  <div class="form-group">
     <label for="user_password">Password</label>
     <input type="password"  class="form-control" autocomplete="off" name="user_password">
  </div>
  
  

   <div class="form-group">
      <input class="btn btn-primary" type="submit" name="edit_user" value="Update User">
  </div>


</form>
