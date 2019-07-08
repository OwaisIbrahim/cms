<?php include "includes/db.php" ?>

<?php include "includes/header.php" ?>
<body>

    <?php include "includes/nav.php" ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">


                <?php 
                    if( isset($_POST['submit']) ) {
                        $searchKeyWord = $_POST['search'];
                        $query = "SELECT * FROM posts where post_tags LIKE '%$searchKeyWord%'";

                        $searchResult = mysqli_query($connection, $query);
                        
                        if(!$searchResult) {
                            die("SOMETHING WENT WRONG" . mysqli_error($searchResult));
                        }

                        $count = mysqli_num_rows($searchResult);
                        if($count == 0) {
                            echo "<h1>No Result Found</h1>";
                            
                        } else {
                            print_r($searchResult);
                            while( $row = mysqli_fetch_assoc($searchResult) ) {
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
                <img class="img-responsive" src=" <?php echo $post_image ?> " alt="">
                <hr>
                <p> <?php echo $post_content ?> </p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                <hr>

                <?php 
                            }
                        }
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
