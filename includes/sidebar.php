
            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">





                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="post">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control">
                            <span class="input-group-btn">
                                <button class="btn btn-default" name="submit" type="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                                   
                            </button>
                            </span>
                        </div>
                    </form>
                    <!-- /.input-group -->
                </div>

                <!-- LOGIN -->
                <div class="well">
                    <?php if( isset($_SESSION['user_role']) ):  ?>
                        <h4>Logged in as <b><?php echo $_SESSION['user_username'] ?></b></h4> 
                        <a href="includes/logout.php" class="btn btn-primary">Logout</a>
                    <?php else: ?>
                    <h4>Login</h4>
                        <form action="includes/login.php" method="post">
                            <div class="form-group">
                                <input type="text" name="username" class="form-control" placeholder="Enter Username">
                            </div>
                            <div class="input-group">                            
                                <input type="password" name="password" class="form-control" placeholder="Enter Password">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" name="login" type="submit">
                                        SUBMIT
                                    </button>
                                </span>
                            </div>                            
                                
                        </form>
                        <!-- /.input-group -->
                    <?php endif; ?>
                    
                </div>





                <!-- Blog Categories Well -->
                <div class="well">
                    
                    <?php 
                        $query = "SELECT * FROM categories LIMIT 4";
                        $all_cat = mysqli_query($connection, $query);
                        if(!$all_cat) {
                            die("ERROR: GetAllCategories Fails at sidebar.php " . mysqli_error($allCat));
                        }                    
                    ?>

                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <?php 
                                    while( $row = mysqli_fetch_assoc($all_cat)) {
                                        $cat_id = $row['cat_id'];
                                        $cat_title = $row['cat_title'];
                                        echo "<li><a href='category.php?category_id=$cat_id'>{$cat_title}</a></li>";
                                    }
                                ?>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <?php include "widget.php" ?>

                

            </div>