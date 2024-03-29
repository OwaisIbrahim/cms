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
                    //GET TOTAL POSTS
                    if( isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin' ) {
                        $post_query_count = "SELECT * FROM posts";
                        
                    } else {
                        $post_query_count = "SELECT * FROM posts WHERE post_status='published'";
                        
                    }
                    $find_count = mysqli_query($connection, $post_query_count);
                    $total_posts = mysqli_num_rows($find_count);

                    if($total_posts < 1) {
                        echo "<h3 class='text-center'>NO POST SORRY</h3>";

                    }

                    $per_page = 2;

                    $count = ceil($total_posts / $per_page);
                    
                    if( isset( $_GET["page"] ) ) {
                        $page = $_GET['page'];
                    } else {
                        $page = "";
                    }

                    if($page=="" || $page==1) {
                        $page_1 = 0;
                    } else {
                        $page_1 = ($page * $per_page) - $per_page;
                    }

                    if( isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin' ) {
                        $all_posts_query = "SELECT * FROM posts LIMIT $page_1, $per_page";
                        
                        
                    } else {    
                        $all_posts_query = "SELECT * FROM posts WHERE post_status='published' LIMIT $page_1, $per_page";                        
                        
                    }

                    $all_posts = mysqli_query($connection, $all_posts_query);

                    while( $row = mysqli_fetch_assoc($all_posts) ) {
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_user  = $row['post_user'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                        $post_status = $row['post_status'];


                ?>
                            <!-- First Blog Post -->
                            <h2>
                                <a href="post/<?php echo $post_id ?>"> <?php echo $post_title ?> </a>
                            </h2>
                            <p class="lead">
                                by <a href="author_posts.php?author=<?php echo $post_user ?>&p_id=<?php echo $post_id ?>"> <?php echo $post_user ?> </a>
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span> Posted on  <?php echo $post_date ?> </p>
                            <hr>
                            <a href="post.php?p_id=<?php echo $post_id ?>">
                                <img class="img-responsive" src=" images/<?php echo imagePlaceholder($post_image); ?> " alt="">
                            </a>
                            <hr>
                            <p> <?php echo $post_content ?> </p>
                            <a class="btn btn-primary" href="post/<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                            <hr>
               

                
                <?php 
                        
                    }
                ?>
                <!-- Pager -->
                <ul class="pager">
                    <?php 
                        for($i = 1; $i <= $count; $i++) {
                            if( $i == $page ) {
                                echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
                            } else {
                                echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
                            }
                        }
                    ?>
                </ul>
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
