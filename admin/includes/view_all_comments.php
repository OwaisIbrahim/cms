
<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>Comment Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php  
            $query = "SELECT * FROM comments";
            $all_comments = mysqli_query($connection, $query);
            while( $row = mysqli_fetch_assoc($all_comments) ) {
                $comment_id = $row['comment_id'];
                $comment_post_id = $row['comment_post_id'];
                $comment_author = $row['comment_author'];
                $comment_email = $row['comment_email'];
                $comment_content = $row['comment_content'];
                $comment_status = $row['comment_status'];
                $comment_date = $row['comment_date'];
                
                echo "<tr>";
                    echo "<td>{$comment_id}</td>"; 
                    echo "<td>{$comment_author}</td>";
                    echo "<td>{$comment_content}</td>";
                    echo "<td>{$comment_email}</td>";
                      
                    // $cat_name_query = "SELECT * FROM categories WHERE cat_id={$post_cat_id}";
                    // $cat_name_query_res = mysqli_query($connection, $cat_name_query);
                    // confirm_query($cat_name_query_res);
                    // while($row = mysqli_fetch_assoc($cat_name_query_res)) {
                    //     $cat_title = $row['cat_title'];
                    //     echo "<td>{$cat_title}</td>";
                    // } 
                    
                    echo "<td>{$comment_status}</td>";
                    
                    $query = "SELECT * FROM posts WHERE post_id=$comment_post_id";
                    $select_post_by_id = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($select_post_by_id) ) {
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
                    }

                    echo "<td>{$comment_date}</td>";
                    echo "<td><a href='comments.php?approve={$comment_id}'>Approve</a></td>";
                    echo "<td><a href='comments.php?unapprove={$comment_id}'>Unapprove</a></td>";
                    echo "<td><a href='comments.php?delete={$comment_id}'>Delete</a></td>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>

<?php
    //DELETE POST
    if( isset( $_GET['delete'] ) ) {
        $the_comment_id = $_GET['delete'];
        $query = "DELETE FROM comments WHERE comment_id = $the_comment_id";
        $delete_query = mysqli_query($connection, $query);
        confirm_query($delete_query);
        header('Location: comments.php');
    }

    
    //APPROVE POST
    if( isset( $_GET['approve'] ) ) {
        $the_comment_id = $_GET['approve'];
        $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $the_comment_id";
        $approve_query = mysqli_query($connection, $query);
        confirm_query($approve_query);
        header('Location: comments.php');
    }
    
    //UNAPPROVE POST
    if( isset( $_GET['unapprove'] ) ) {
        $the_comment_id = $_GET['unapprove'];
        $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $the_comment_id";        
        $unapprove_query = mysqli_query($connection, $query);
        confirm_query($unapprove_query);
        header('Location: comments.php');
    }
?>