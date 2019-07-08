       
                <!-- /.row -->
<div class="widgets"> 
    <div class="total_counts">      
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-file-text fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                            <?php 
                                //POST COUNT
                                $query = "SELECT COUNT(*) 'total_posts' FROM posts";
                                $post_count_query = mysqli_query($connection, $query);
                                if( !$post_count_query ) {
                                    die("QUERY ERROR: " .mysqli_error($connection) );
                                }
                                while( $row = mysqli_fetch_assoc($post_count_query) ) {
                                    $post_count = $row['total_posts'];
                                }

                                //PUBLISHED POST COUNT
                                $query = "SELECT COUNT(*) 'total_posts' FROM posts WHERE post_status='published'";
                                $published_post_count_query = mysqli_query($connection, $query);
                                if( !$published_post_count_query ) {
                                    die("QUERY ERROR: " .mysqli_error($connection) );
                                }
                                while( $row = mysqli_fetch_assoc($published_post_count_query) ) {
                                    $published_post_count = $row['total_posts'];
                                }

                                //DRAFT POST COUNT
                                $query = "SELECT COUNT(*) 'total_posts' FROM posts WHERE post_status='draft'";
                                $draft_post_count_query = mysqli_query($connection, $query);
                                if( !$draft_post_count_query ) {
                                    die("QUERY ERROR: " .mysqli_error($connection) );
                                }
                                while( $row = mysqli_fetch_assoc($draft_post_count_query) ) {
                                    $draft_post_count = $row['total_posts'];
                                }

                                //COMMENTS COUNT
                                $query = "SELECT COUNT(*) 'total_comments' FROM comments";
                                $comment_count_query = mysqli_query($connection, $query);
                                if( !$comment_count_query ) {
                                    die("QUERY ERROR: " .mysqli_error($connection) );
                                }
                                while( $row = mysqli_fetch_assoc($comment_count_query) ) {
                                    $comment_count = $row['total_comments'];
                                }

                                //UNAPPROVE COMMENTS COUNT
                                $query = "SELECT * FROM comments WHERE comment_status='unapproved'";
                                $unapprove_comment_count_query = mysqli_query($connection, $query);
                                $unapprove_comment_count = mysqli_num_rows($unapprove_comment_count_query);

                                //USERS COUNT
                                $query = "SELECT COUNT(*) 'total_users' FROM users";
                                $user_count_query = mysqli_query($connection, $query);
                                if( !$user_count_query ) {
                                    die("QUERY ERROR: " .mysqli_error($connection) );
                                }
                                while( $row = mysqli_fetch_assoc($user_count_query) ) {
                                    $user_count = $row['total_users'];
                                }

                                //SUBSCRIBER USER COUNT
                                $query = "SELECT * FROM users WHERE user_role='subscriber'";
                                $select_all_subscriber = mysqli_query($connection, $query);
                                $subscriber_count = mysqli_num_rows($select_all_subscriber);

                                //CATEGORIES COUNT
                                $query = "SELECT COUNT(*) 'total_categories' FROM categories";
                                $categories_count_query = mysqli_query($connection, $query);
                                if( !$categories_count_query ) {
                                    die("QUERY ERROR: " .mysqli_error($connection) );
                                }
                                while( $row = mysqli_fetch_assoc($categories_count_query) ) {
                                    $categories_count = $row['total_categories'];
                                }
                            ?>
                        <div class='huge'><?php echo $post_count ?></div>
                                <div>Posts</div>
                            </div>
                        </div>
                    </div>
                    <a href="posts.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                            <div class='huge'><?php echo $comment_count ?></div>
                            <div>Comments</div>
                            </div>
                        </div>
                    </div>
                    <a href="comments.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                            <div class='huge'><?php echo $user_count ?></div>
                                <div> Users</div>
                            </div>
                        </div>
                    </div>
                    <a href="users.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-list fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class='huge'><?php echo $categories_count ?></div>
                                <div>Categories</div>
                            </div>
                        </div>
                    </div>
                    <a href="categories.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
                <!-- /.row -->

    <div class="graphs">
        <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
        <div class="row">
            <script type="text/javascript">
                google.charts.load('current', {'packages':['bar']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Data ', 'Count'],

                    <?php 
                        $element_text = ['Active Posts', 'Active Posts', 'Draft Posts', 'Comments', 'Pending Comments', 'Users', 'Subscribers', 'Categories'];
                        $element_count = [$post_count, $published_post_count, $draft_post_count, $comment_count, $unapprove_comment_count, $user_count, $subscriber_count, $categories_count];

                        for( $i=0; $i < 7; $i++ ) {
                            echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
                        }
                    ?>

                    // ['Posts', 1000];
                ]);

                var options = {
                    chart: {
                    title: 'Company Performance',
                    subtitle: '',
                    }
                };

                var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                chart.draw(data, google.charts.Bar.convertOptions(options));
                }
            </script>
        </div>
    </div>
</div> 