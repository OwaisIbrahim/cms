<?php include "includes/db.php" ?>

<?php include "includes/header.php" ?>
<body>

    <?php include "includes/nav.php" ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Posts
                <?php 
                    if( isset( $_GET['p_id'] ) ) {
                        $the_post_id = $_GET['p_id'];
                    
                        $query = "UPDATE posts SET post_views_count=post_views_count+1 WHERE post_id = $the_post_id";
                        $send_query = mysqli_query($connection, $query);
                        if(!$send_query) {
                            die("QUERY FAILED: " . mysqli_error($connection) );
                        }

                        if( isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin' ) {
                            $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
                        } else {
                            $query = "SELECT * FROM posts WHERE post_id = $the_post_id AND post_status='published'";
                        }


                        $all_posts = mysqli_query($connection, $query);
                        
                        if(mysqli_num_rows($all_posts) < 1) {
                            echo "<h3 class='center'>No Post Sorry</h3>";
                        } 
                        else {

                            while( $row = mysqli_fetch_assoc($all_posts) ) {
                                $post_title = $row['post_title'];
                                $post_author = $row['post_author'];
                                $post_date = $row['post_date'];
                                $post_image = $row['post_image'];
                                $post_content = $row['post_content'];
                    ?>   
                                <!-- First Blog Post -->
                                <h2>
                                    <a href="#"> <?php echo $post_title ?> </a>
                                </h2>
                                <p class="lead">
                                    by <a href="index.php"> <?php echo $post_author ?> </a>
                                </p>
                                <p><span class="glyphicon glyphicon-time"></span> Posted on  <?php echo $post_date ?> </p>
                                <hr>
                                <img class="img-responsive" src="/cms/images/<?php echo imagePlaceholder($post_image); ?> " alt="">
                                <hr>
                                <p> <?php echo $post_content ?> </p>
                                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                                <hr>

                            <?php 
                            } 
                            ?>

                            <?php include "includes/comments.php" ?>

                            <!-- Pager -->
                            <ul class="pager">
                                <li class="previous">
                                    <a href="#">&larr; Older</a>
                                </li>
                                <li class="next">
                                    <a href="#">Newer &rarr;</a>
                                </li>
                            </ul>
                        <?php 
                        }
                    } else {
                        header("Location: index.php");
                    }
                        ?>
                </div>
                
            <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>
        <?php include "includes/footer.php" ?>
    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
