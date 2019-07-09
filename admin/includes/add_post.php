
<?php 
    if( isset($_POST['create_post']) ) {
        $post_title = escape($_POST['post_title']);
        $post_cat_id = $_POST['post_category'];
        $post_user = $_POST['post_user'];
        $post_content = mysqli_real_escape_string($connection, $_POST['post_content']);
        $post_tags = $_POST['post_tags'];
        $post_status = $_POST['post_status'];

        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];

        $post_date = date('d-m-y');
        $post_comment_count = 0;

        move_uploaded_file($post_image_temp, "../images/$post_image");

        $query = "INSERT INTO posts(post_cat_id, post_title, post_user, post_date,post_image,post_content,post_tags,post_comment_count,post_status) ";
        $query .= "VALUES({$post_cat_id},'{$post_title}','{$post_user}',now(),'{$post_image}','{$post_content}','{$post_tags}', '{$post_comment_count}', '{$post_status}') "; 
        $create_post_query = mysqli_query($connection, $query);

        confirm_query($create_post_query);

        //Pull last created ID of connection
        $the_post_id = mysqli_insert_id($connection);

        echo "<p class='bg-success'>Post Created. <a href='../post.php?p_id={$the_post_id}'>View Post </a> or <a href='posts.php'>Edit More Posts</a></p>";


        
       

    }
?>

    <form action="" method="post" enctype="multipart/form-data">    
     
     
      <div class="form-group">
         <label for="post_title">Post Title</label>
          <input type="text" class="form-control" name="post_title">
      </div>




      <div class="form-group">
        <label for="post_category">Categories: </label>
        <br>
        <select name="post_category" id="post_category">
            <?php 
                $query = "SELECT * FROM categories";
                $select_cat_query = mysqli_query($connection, $query);
                confirm_query($select_cat_query);
                while($row = mysqli_fetch_assoc($select_cat_query)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];    
                    echo "<option value='$cat_id'>{$cat_title}</option>";
                }
            ?>
        </select>
     </div>

     <div class="form-group">
        <label for="post_user">Users: </label>
        <br>
        <select name="post_user" id="post_user">
            <?php 
                $query = "SELECT * FROM users";
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
          <input type="text" class="form-control" name="post_author">
      </div> -->

       <div class="form-group">
         <label for="post_status">Status: </label>
         <br>       
         <select name="post_status" id="">
             <option value="draft">Post Status</option>
             <option value="published">Published</option>
             <option value="draft">Draft</option>
         </select>
      </div>
      
      
      
    <div class="form-group">
         <label for="post_image">Post Image</label>
          <input type="file"  name="image">
      </div>

      <div class="form-group">
         <label for="post_tags">Post Tags</label>
          <input type="text" class="form-control" name="post_tags">
      </div>
      
      <div class="form-group">
         <label for="post_content">Post Content</label>
         <textarea class="form-control "name="post_content" id="postContentBody" cols="30" rows="10">
         </textarea>
      </div>
      
      

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
      </div>


</form>
    