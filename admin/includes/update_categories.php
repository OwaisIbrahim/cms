
<form action="" method="post">
    <div class="form-group">

    <?php 
        //GET CATEGORY OF EDIT ID
        if( isset( $_GET['edit'] ) ) {
            $edit_cat_id = $_GET['edit'];
            $query = "SELECT * FROM categories WHERE cat_id={$edit_cat_id}";
            $cat_to__edit = mysqli_query($connection, $query);
            while( $row = mysqli_fetch_assoc($cat_to__edit) ) {
                $update_cat_id = $row['cat_id'];
                $update_cat_title = $row['cat_title'];
            ?>
                <label for="cat_title">Update Category</label>
                <input type="text" class="form-control" name="cat_title" value="<?php echo $update_cat_title ?>">
            <?php
            }
        }  
    ?>
    <?php 
        //UPDATE ON EDIT ID
        if( isset($_POST['update_category']) ) {
            $latest_cat_title = $_POST['cat_title'];
            $query = "UPDATE categories SET cat_title='{$latest_cat_title}' WHERE cat_id={$update_cat_id}";
            $update_query = mysqli_query($connection, $query);
            if( !$update_query ) {
                die("UPDATE QUERY FAILS: " . mysqli_error($connection) );
            } else {
                header("Location: categories.php");
            }
        }
    ?>

        
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_category" value="Update">
    </div>
</form>