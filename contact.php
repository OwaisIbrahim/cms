<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php  include "includes/nav.php"; ?>

<?php 

    
            // the message
            $msg = "First line of text\nSecond line of text";

            // use wordwrap() if lines are longer than 70 characters
            $msg = wordwrap($msg,70);
            
            // send email
            echo "I AM IN";
            
?>

    <?php
        if( isset($_POST['submit']) )
        {
            $to = "eventsharingteam@gmail.com";
            $subject = wordwrap($_POST['subject']);
            $body = $_POST['body'];
            $header = "From: " . $_POST['email'];
            mail($to,$subject,$body, $header);

            


        }
    ?>
 
    <!-- Page Content -->
<div class="container">
    
    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                    <h1>Contact</h1>
                        <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">
                            
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your Email" >
                            </div>
                            <div class="form-group">
                                <label for="subject" class="sr-only">Subject</label>
                                <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter your subject" >
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="body" id="postContentBody" cols="30" rows="10"></textarea>
                            </div>
                    
                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                        </form>
                    
                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>
    <hr>

<?php include "includes/footer.php";?>
</div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
