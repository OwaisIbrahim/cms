<?php 
    if( isset( $_GET['p_id'] ) ) {
        $the_post_id = $_GET['p_id'];
    }
        
        $query = "SELECT * FROM POSTS WHERE post_id={$the_post_id}";
        $all_posts = mysqli_query($connection, $query);
        while( $row = mysqli_fetch_assoc($all_posts) ) {
            $post_title = $row['post_title'];
            $post_content = $row['post_content'];
            
            $post_user = $row['post_user'];
            $post_cat_id = $row['post_cat_id'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_tags = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_date = $row['post_date'];
        }

        if( isset( $_POST['update_post'] ) ) {
            $post_title = $_POST['post_title'];
            $post_content = $_POST['post_content'];
            $post_content = mysqli_real_escape_string($connection, $post_content);
            $post_user = $_POST['post_user'];
            $post_cat_id = $_POST['post_cat_id'];
            $post_status = $_POST['post_status'];
            $post_image = $_FILES['image']['name'];
            $post_image_temp = $_FILES['image']['tmp_name'];
            $post_tags = $_POST['post_tags'];

            move_uploaded_file($post_image_temp, "../images/$post_image");

            //FOR DEFAULT IMAGE ON EDIT POST
            if( empty( $post_image ) ) {
                $query = "SELECT * FROM posts WHERE post_id=$the_post_id ";
                $query_result = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($query_result) ) {
                    $post_image = $row['post_image'];
                }
            }

            $query = "UPDATE posts SET ";
            $query .= "post_title = '{$post_title}', ";
            $query .= "post_cat_id = '{$post_cat_id}', ";
            $query .= "post_date = now(), ";
            $query .= "post_user = '{$post_user}', ";
            $query .= "post_status = '{$post_status}', ";
            $query .= "post_tags = '{$post_tags}', ";
            $query .= "post_content = '{$post_content}', ";
            $query .= "post_image = '{$post_image}' ";
            $query .= "WHERE post_id={$the_post_id} ";

            $update_post_query = mysqli_query($connection, $query);
    
            confirm_query($update_post_query);
            
     
     echo "<p class='bg-success'>Post Updated. <a href='../post.php?p_id={$the_post_id}'>View Post </a> or <a href='posts.php'>Edit More Posts</a></p>";

        }

?>
    <form action="" method="post" enctype="multipart/form-data">    
     
     <div class="form-group">
        <label for="post_title">Post Title</label>
         <input type="text" class="form-control" name="post_title" value='<?php echo $post_title ?>'>
     </div> 

     <div class="form-group">
        <label for="post_category">Categories: </label>
        <br>
        <select name="post_cat_id" id="">
            <?php 
                $query = "SELECT * FROM categories";
                $select_cat_query = mysqli_query($connection, $query);
                confirm_query($select_cat_query);
                while($row = mysqli_fetch_assoc($select_cat_query)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    
                    if($cat_id == $post_cat_id) {
                        echo "<option selected value='$cat_id'>{$cat_title}</option>";
                    } else {
                        echo "<option value='$cat_id'>{$cat_title}</option>";
                    }
                }
            ?>
        </select>
     </div>

     <div class="form-group">
        <label for="post_user">Users: </label>
        <br>
        <select name="post_user" id="post_user">
            
            <?php //SHOW DEFAULT USER
                echo "<option value='$post_user'>{$post_user}</option>"; 
            ?>
            <?php //FETCH USERS OTHER THAN DEFAULT
                $query = "SELECT * FROM users WHERE user_username!='{$post_user}'";
                $select_user_query = mysqli_query($connection, $query);
                confirm_query($select_user_query);
                while($row = mysqli_fetch_assoc($select_user_query)) {
                    $user_id = $row['user_id'];
                    $user_username = $row['user_username'];    
                    echo "<option value='$user_username'>{$user_username}</option>";
                }
            ?>
        </select>
     </div>
     
     <!-- <div class="form-group">
        <label for="post_author">Post Author</label>
         <input type="text" class="form-control" name="post_author" value='<?php echo $post_author ?>'>
     </div> -->
     <div class="form-group">
        <label for="post_status">Status: </label>
        <br>
        <select name="post_status" id="">
        
                <option value="<?php echo $post_status; ?>">
                    <?php echo $post_status; ?>
                </option>
                <?php 
                    if($post_status == 'published') {
                        echo "<option value='draft'>Draft</option>";
                    } else {
                        echo "<option value='published'>Publish</option>";
                    }
                ?>
        </select>
    </div>

     
      <div class="form-group">
        <label for="post_image">Post Image</label><br>
        <img width='100' src="../images/<?php echo $post_image ?>" alt="">    
         <input type="file"  name="image" >
     </div>

     <div class="form-group">
        <label for="post_tags">Post Tags</label>
         <input type="text" class="form-control" name="post_tags" value='<?php echo $post_tags ?>'>
     </div>
     
     <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control "name="post_content" id="postContentBody" cols="30" rows="10" ><?php echo $post_content ?>
        </textarea>
     </div>
     
     

      <div class="form-group">
         <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
     </div>


</form>
   