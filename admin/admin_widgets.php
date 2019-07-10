       
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
                                    //PUBLISHED POST COUNT
                                    $published_post_count = check_status('posts', 'post_status', 'published');

                                    //DRAFT POST COUNT
                                    $draft_post_count = check_status('posts', 'post_status', 'draft');

                                    //UNAPPROVE COMMENTS COUNT
                                    $unapprove_comment_count = check_status('comments', 'comment_status', 'unapproved');
                                    
                                    //SUBSCRIBER USER COUNT
                                   $subscriber_count = check_status('users', 'user_role', 'subscriber');

                                    
                                ?>
                                <div class='huge'>
                                    <?php //TOTAL POST COUNT
                                        echo $post_count = record_count('posts'); 
                                    ?>
                                </div>
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
                                <div class='huge'>
                                    <?php //COMMENTS COUNTS
                                        echo $comment_count = record_count('comments'); 
                                    ?>
                                </div>
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
                                <div class='huge'>
                                    <?php //USER COUNT
                                        echo $user_count = record_count('users'); 
                                    ?>
                                </div>
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
                                <div class='huge'>
                                    <?php //CATEGORIES COUNT
                                        echo $categories_count = record_count('categories'); 
                                    ?>
                                </div>
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
                        $element_text = ['Total Posts', 'Active Posts', 'Draft Posts', 'Comments', 'Pending Comments', 'Users', 'Subscribers', 'Categories'];
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