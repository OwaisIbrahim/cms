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
                    if( isset( $_GET['p_id'] ) ) {
                        $the_post_id = $_GET['p_id'];
                        $the_post_author = $_GET['author'];
                    }
                    $query = "SELECT * FROM posts WHERE post_user = '{$the_post_author}'";
                    $all_posts = mysqli_query($connection, $query);

                    while( $row = mysqli_fetch_assoc($all_posts) ) {
                        $post_title = $row['post_title'];
                        $post_user = $row['post_user'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                ?>
                


                
                <!-- First Blog Post -->
                <h2>
                    <a href="#"> <?php echo $post_title ?> </a>
                </h2>
                <p class="lead">
                    All Post by  <b><?php echo $post_user ?></b> </a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on  <?php echo $post_date ?> </p>
                <hr>
                <img class="img-responsive" src=" images/<?php echo $post_image ?> " alt="">
                <hr>
                <p> <?php echo $post_content ?> </p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                <hr>

                <?php 
                    }
                ?>


                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
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
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
