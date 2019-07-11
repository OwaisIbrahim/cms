
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/cms/">CMS PROJECT</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

                    <?php 
                        $query = "SELECT * FROM categories";
                        $all_categories = mysqli_query($connection, $query);
                        while($row = mysqli_fetch_assoc($all_categories)) {
                            $cat_id = $row['cat_id'];
                            $cat_title = $row['cat_title'];
                            echo "<li><a href='/cms/category/{$cat_id}'> {$cat_title} </a></li>";
                        }
                    ?>
                    <?php $navClassArr = [ "index.php" => "", "Registration.php" => "" , "contact.php" => "", "login.php" => ""]; ?>
                    <?php 
                        $pageName = basename($_SERVER['PHP_SELF']);
                        echo $pageName;
                        echo $navClassArr[$pageName] = 'active';
                    ?>
                    <?php if( isLoggedIn() ): ?>
                        <li  class="<?php echo $navClassArr["index.php"]; ?>">
                            <a href="/cms/admin">Admin </a>
                        </li>
                    <?php else: ?>
                        <li  class="<?php echo $navClassArr["Registration.php"]; ?>">
                            <a href="/cms/Registration">Registration</a>
                        </li>
                        <li  class="<?php echo $navClassArr["login.php"]; ?>">
                            <a href="/cms/login">Login</a>
                        </li>
                    <?php endif; ?>

                    
                    <li class="<?php echo $navClassArr["contact.php"]; ?>">
                        <a href="/cms/contact">Contact</a>
                    </li>
                    <?php 
                        if( isset($_SESSION['user_role']) ) {
                            echo "SESSION EXIST: " . $_SESSION['user_role'];
                            if( isset($_GET['p_id']) ) {
                                $the_post_id = $_GET['p_id'];
                                echo "<li><a href='/cms/admin/posts.php?source=edit&p_id=$the_post_id'>Edit Post</a></li>";
                            }
                        } else {
                            echo "SESSION NOT EXIST: ";

                        }
                    ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
