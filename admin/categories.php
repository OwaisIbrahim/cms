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
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                        <div class="col-xs-6">

                            <?php insert_categories(); ?>

                            

                            <?php 
                                //DELETE CATEGORY
                                delete_categories();
                            ?>

                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat_title">Add Category</label>
                                    <input type="text" class="form-control" name="cat_title">
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" name="submit" value="Add">
                                </div>
                            </form>

                            <!-- UPDATE CATEGORY -->
                            <?php 
                                if( isset($_GET['edit'] ) ) {
                                    $edit_cat_id = $_GET['edit'];
                                    include "includes/update_categories.php" ;
                                }
                            ?>
                        </div>
                        <div class="col-xs-6">
                            <h4><b>Category details</b></h4>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php 
                                        //FIND ALL CATEGORIES
                                        find_all_categories();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                        
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
