<?php
    if( isset($_POST['checkBoxArray']) ) {
        foreach( $_POST['checkBoxArray'] as $postValueId ) {
            $bulk_options = $_POST['bulk_options'];

            switch($bulk_options) {
                case 'published':
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id={$postValueId}";
                    $update_to_publish_status = mysqli_query($connection, $query);
                    confirm_query($update_to_publish_status);
                    break;
                case 'draft':
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id={$postValueId}";
                    $update_to_draft_status = mysqli_query($connection, $query);
                    confirm_query($update_to_draft_status);
                    break;
                case 'delete':
                    $query = "DELETE FROM posts WHERE post_id={$postValueId}";
                    $update_to_delete_status = mysqli_query($connection, $query);
                    confirm_query($update_to_delete_status);
                    break;
                case 'clone':
                    $query = "SELECT * FROM posts WHERE post_id={$postValueId}";
                    $select_post_query = mysqli_query($connection, $query);
                    confirm_query($select_post_query);

                    while( $row = mysqli_fetch_array($select_post_query) ) {
                        $post_title = $row['post_title'];
                        $post_cat_id = $row['post_cat_id'];
                        $post_date = $row['post_date'];
                        $post_author = $row['post_author'];
                        $post_user = $row['post_user'];
                        $post_status = $row['post_status'];
                        $post_image = $row['post_image'];
                        $post_tags = $row['post_tags'];
                        $post_content = $row['post_content'];
                    }

                    $query = "INSERT INTO posts(post_cat_id, post_title, post_author, post_user, post_date, post_status, post_image, post_tags, post_content) ";
                    $query .= "VALUES($post_cat_id, '{$post_title}', '{$post_author}', '{$post_user}', now(), '{$post_status}', '{$post_image}', '{$post_tags}', '{$post_content}')";
                    $copy_query = mysqli_query($connection, $query);
                    if( !$copy_query ) {
                        die("QUERY FAILS: " . mysqli_error($connection) );
                    }
                    break;
            }
        }
    }
?>


<form action="" method="post">
    <table class="table table-hover">
    <div id="bulkOptionContainer" class="col-xs-4">
        <select class="form-control" name="bulk_options" id="">
            <option value="">Select Options</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
            <option value="delete">Delete</option>  
            <option value="clone">Clone</option>
        </select>
    </div>
    <div class="col-xs-4">
        <input type="submit" name="submit" class="btn btn-success" value="Apply">
        <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
    </div>
        <thead>
            <tr>
                <th><input id="selectAllBoxes" type="checkbox"></th>
                <th>Post Id</th>
                <th>Users</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Total Comments</th>
                <th>Date</th>
                <th>View Post</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Total Views</th>

            </tr>
        </thead>
        <tbody>
            <?php  
                // $query = "SELECT * FROM posts ORDER BY post_id DESC";
                $query = "SELECT posts.post_id, posts.post_author, posts.post_user, posts.post_title, posts.post_cat_id, posts.post_status, posts.post_image, ";
                $query .= "posts.post_tags, posts.post_comment_count, posts.post_date, posts.post_views_count, categories.cat_id, categories.cat_title ";
                $query .= "FROM posts ";
                $query .= "LEFT JOIN categories ON posts.post_cat_id = categories.cat_id ";
                $query .= "ORDER BY posts.post_id DESC";
                $all_posts = mysqli_query($connection, $query);
                confirm_query($all_posts);
                while( $row = mysqli_fetch_assoc($all_posts) ) {
                    $post_image = $row['post_image'];
                    $post_id = $row['post_id'];
                    $post_cat_id = $row['post_cat_id'];
                    $post_author = $row['post_author'];
                    $post_user = $row['post_user'];
                    $post_title = $row['post_title'];
                    $post_status = $row['post_status'];
                    $post_tags = $row['post_tags'];
                    $post_date = $row['post_date'];
                    $post_views_count = $row['post_views_count'];
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];

                    
                    

                    echo "<tr>";
                        echo "<td ><input class='checkBox' type='checkbox' name='checkBoxArray[]' value='$post_id'></td>";
                        echo "<td>{$post_id}</td>"; 

                        if( !empty($post_author) ) {
                            echo "<td>{$post_author}</td>";
                        } elseif ( !empty($post_user) ) {
                            echo "<td>{$post_user}</td>";
                        }

                        echo "<td>{$post_title}</td>";
                        // $cat_name_query = "SELECT * FROM categories WHERE cat_id={$post_cat_id}";
                        // $cat_name_query_res = mysqli_query($connection, $cat_name_query);
                        // confirm_query($cat_name_query_res);
                        // while($row = mysqli_fetch_assoc($cat_name_query_res)) {
                            // $cat_title = $row['cat_title'];
                            echo "<td>{$cat_title}</td>";
                        // } 
                        echo "<td>{$post_status}</td>";
                        echo "<td><img width='100' class='img-responsive' src='../images/$post_image' alt='image'></td>";
                        echo "<td>{$post_tags}</td>";

                        $query = "SELECT * FROM comments where comment_post_id=$post_id";
                        $send_comment_query = mysqli_query($connection, $query);
                        $post_comment_count = mysqli_num_rows($send_comment_query);
    
                        echo "<td><a href='post_comments.php?p_id=$post_id'>{$post_comment_count}</a></td>";
                        echo "<td>{$post_date}</td>";
                        echo "<td><a href='../post.php?p_id={$post_id}'>View</a></td>";
                        echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                        echo "<td><a  onClick=\"javascript: return confirm('Are you sure you want to delete?');\" href='posts.php?delete={$post_id}'>Delete</a></td>";
                        echo "<td><a href='posts.php?reset={$post_id}'>{$post_views_count}</a></td>";

                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</form>
<?php
    // DELETE POST
    if( isset( $_GET['delete'] ) ) {
        if( isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
            $the_post_id = mysqli_real_escape_string($connection, $_GET['delete']);
            $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
            $delete_query = mysqli_query($connection, $query);
            confirm_query($delete_query);
            header("Location: posts.php");
        }
    }

    // DELETE POST
    if( isset( $_GET['reset'] ) ) {
        $the_post_id = escaoe($_GET['reset']);
        $query = "UPDATE posts SET post_views_count=0 WHERE post_id =" . mysqli_real_escape_string($connection, $_GET['reset']) . " ";
        $reset_query = mysqli_query($connection, $query);
        confirm_query($reset_query);
        header("Location: posts.php");
    }
?>