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
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <?php 

                    if( isset( $_GET['category_id'] ) ) {
                        $post_category_id = $_GET['category_id'];
                    
                        // if( isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin' ) {
                            if( is_admin($_SESSION['user_username']) ) {
                            // $query = "SELECT * FROM posts WHERE post_cat_id=$post_category_id";
                            $placeHolder_query = "SELECT post_id, post_title, post_author, post_date, post_image, post_content FROM posts WHERE post_cat_id = ?";
                            $stmt1 = mysqli_prepare($connection, $placeHolder_query);
                            
                        } else {
                            // $query = "SELECT post_id, post_title, post_author, post_date, post_image, post_content FROM posts WHERE post_cat_id=$post_category_id AND post_status='published'";
                            $stmt2 = "SELECT post_id, post_title, post_author, post_date, post_image, post_content FROM posts WHERE post_cat_id = ? AND post_status =  ?";
                            $var_published = "published";
                        }

                        if( isset($stmt1) ) {
                            mysqli_stmt_bind_param($stmt1, "i", $post_category_id);
                            mysqli_stmt_execute($stmt1);
                            mysqli_stmt_bind_result($stmt1, $post_id, $post_title, $post_author, $post_date, $post_image, $post_content);
                            $stmt = $stmt1;
                        } else {
                            mysqli_stmt_bind_param($stmt2, "is", $post_category_id, $var_published);
                            mysqli_stmt_execute($stmt2);
                            mysqli_stmt_bind_result($stmt2, $post_id, $post_title, $post_author, $post_date, $post_image, $post_content);
                            $stmt = $stmt1;
                        }



                        // $all_posts = mysqli_query($connection, $query);

                        if(mysqli_stmt_num_rows($stmt)  === 0) {
                            echo "<h3 class='text-center'>No Categories SORRY</h3>";
                        } 
                        while( mysqli_stmt_fetch($stmt) ): 
                                
                            ?>
                        
                            <!-- First Blog Post -->
                            <h2>
                                <a href="post.php?p_id=<?php echo $post_id ?>"> <?php echo $post_title ?> </a>
                            </h2>
                            <p class="lead">
                                by <a href="index.php"> <?php echo $post_author ?> </a>
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span> Posted on  <?php echo $post_date ?> </p>
                            <hr>
                            <img class="img-responsive" src="/cms/images/<?php echo $post_image ?> " alt="">
                            <hr>
                            <p> <?php echo $post_content ?> </p>
                            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                            <hr>

                      

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
                        endwhile;
                        mysqli_stmt_close($stmt);
                    } 
                    else {
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
    <script src="/cms/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/cms/js/bootstrap.min.js"></script>

</body>

</html>
