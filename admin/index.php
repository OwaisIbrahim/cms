<?php include "includes/admin_header.php" ?>
<body>

    <div id="wrapper">
        <!-- Navigation -->
        <?php include "includes/admin_nav.php" ?>
        
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>
                                <?php echo $_SESSION['user_username'] ?>
                            </small>
                        </h1>
                        
                            <?php include "admin_widgets.php" ?>

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
    <script type="text/javascript"  src="js/admin_script.js"></script>


    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
