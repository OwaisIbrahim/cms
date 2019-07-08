<div class="comments">
    
    <!-- Blog Comments -->

    <?php 
        //ADD COMMENT
        if( isset( $_POST['create_comment'] ) ) {
            
            $the_post_id = $_GET['p_id'];

            $comment_author = $_POST['comment_author'];
            $comment_email = $_POST['comment_email'];
            $comment_content = $_POST['comment_content'];

            $query = "INSERT INTO comments( comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
            $query .= "VALUES($the_post_id, '$comment_author', '$comment_email', '$comment_content', 'unapproved', now())";

            $insert_comment = mysqli_query($connection, $query);
            if( !$insert_comment ) {
                echo "QUERY ERROR: " . mysqli_error($connection);
            }
            
        }
    ?>


    <!-- Comments Form -->
    <div class="well">
        <h4>Leave a Comment:</h4>
        <form action="" role="form" method="post">
            <div class="form-group">
                <label for="comment_author">Author</label>
                <input type="text" class="form-control" name="comment_author" required>
            </div>
            <div class="form-group">
                <label for="comment_email">Email</label>
                <input type="email" class="form-control" name="comment_email" required>
            </div>
            <div class="form-group">
                <label for="comment_content">Your Comment</label>
                
                <textarea class="form-control" rows="3" name="comment_content" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="create_comment">POST COMMENT</button>
        </form>
    </div>

    <hr>




    <?php

        $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} ";
        $query .= "AND comment_status = 'approved' ";
        $query .= "ORDER BY comment_id DESC ";
        $select_comment_query = mysqli_query($connection, $query);
        if( !$select_comment_query ) {
            die("QUERY FAILED: " . mysqli_error($connection));
        }
        while( $row = mysqli_fetch_assoc($select_comment_query) ) {
            $comment_date = $row['comment_date'];
            $comment_content = $row['comment_content'];
            $comment_author = $row['comment_author'];

            ?>
            <!-- Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $comment_author ?>
                        <small><?php echo $comment_date ?></small>
                    </h4>
                    <?php echo $comment_content ?>
                </div>
            </div>
    <?php
        }
    ?>

    <!-- Posted Comments -->

    
</div>




