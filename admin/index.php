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

    <!-- NOTIFICATION SCRIPTES -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha256-ENFZrbVzylNbgnXx0n3I1g//2WeO47XxoPe0vkp3NC8=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha256-3blsJd4Hli/7wCQ+bmgXfOdK7p/ZUMtPXY08jmxSSgk=" crossorigin="anonymous"></script>
    <script src="https://js.pusher.com/4.4/pusher.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script>
        $(document).ready( function() {
            const pusher = new Pusher('04c47390a30c68aa087a', {
                cluster: 'ap2',
                forceTLS: true
            });
            var notificationChannel = pusher.subscribe('notifications');
            notificationChannel.bind('new_user', function(notification) {
                var message = notification.message;
                toastr.success(`${message} just registered` );
                console.log(message);
            });
        });
        
    </script>
</body>

</html>
