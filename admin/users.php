<?php ob_start(); ?> <!-- REMOVE BUFFER CACHE IF PAGE RELOADS -->
<?php include "includes/admin_header.php" ?>
<body>

    <div id="wrapper">

        <?php if($connection) echo "connection" ?>

        <!-- Navigation -->
        <?php include "includes/admin_nav.php" ?>
        
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        
                        <h1 class="page-header">
                            Welcome to Admin 
                            <small>Author</small>
                        </h1>

                        <?php 

                            if( isset($_GET['source']) ) {
                                $source_post_id = $_GET['source'];
                            } else {
                                $source_post_id = '';
                            }

                            switch ($source_post_id) {
                                case 'add_user':
                                    include "includes/add_user.php";
                                    break;
                                case 'edit_user':
                                    include "includes/edit_user.php";
                                    break;
                                
                                default:
                                    include "includes/view_all_users.php";
                                    break;
                            }

                                // $source_post_id = $_GET['source'];
                                // $query = "SELECT * FROM posts WHERE post_id={$source_post_id}";
                                // $searched_posts = mysqli_query($connection, $query);
                                // while( $row = mysqli_fetch_assoc($searched_posts) ) {
                                //     $img_src = $row['post_image'];
                                //     echo "<tr>";
                                //         echo "<td>{$row['post_id']}</td>";
                                //         echo "<td>{$row['post_author']}</td>";
                                //         echo "<td>{$row['post_title']}</td>";
                                //         echo "<td>{$row['post_cat_id']}</td>";
                                //         echo "<td>{$row['post_status']}</td>";
                                //         echo "<td><img width='100' class='img-responsive' src='$img_src' alt='image'></td>";
                                //         echo "<td>{$row['post_tags']}</td>";
                                //         echo "<td>{$row['post_comment_count']}</td>";
                                //         echo "<td>{$row['post_date']}</td>";
                                //     echo "</tr>";
                                
                            // }

                        ?>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
