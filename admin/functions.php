<?php

    function escape($string) {
        global $connection;
        return mysqli_real_escape_string($connection, trim($string));
    }

    function users_online() {

        if( isset($_GET['onlineusers']) ) {
            global $connection;
            if( !$connection ) {
                session_start();
                include("../includes/db.php");
                
                $session = session_id();
                $time = time();
                $time_out_in_seconds = 05;  //05 seconds
                $time_out = $time - $time_out_in_seconds;

                $query = "SELECT * FROM users_online WHERE session='$session'";
                $send_query = mysqli_query($connection, $query);
                $count = mysqli_num_rows($send_query);

                if($count == NULL) {
                    $query = "INSERT INTO users_online(session, time) VALUES('$session', '$time')";
                } else {
                    $query = "UPDATE users_online SET time='$time' WHERE session='$session'";
                }
                mysqli_query($connection, $query);
                $online_user_query = "SELECT * FROM users_online WHERE time > '$time_out'";
                $users_online = mysqli_query($connection, $online_user_query);

                $count_users = mysqli_num_rows($users_online);
            
                echo $count_users;
            }

        } //GET REQUEST isset()
    }
users_online();

    function confirm_query($result) {
        global $connection;        
        if( !$result ) {
            die("QUERY FAILS: " . mysqli_error($connection) );
        }
    }

    function insert_categories() {
        global $connection;
        if( isset($_POST['submit']) ) {
            $cat_title = $_POST['cat_title'];
            
            if($cat_title == "" || empty($cat_title)) {
                echo "This field should not be empty";
            } else {
                $insert_cat_query = "INSERT INTO categories(cat_title) ";
                $insert_cat_query .= "VALUE('{$cat_title}') ";

                $insert_cat_query_result = mysqli_query($connection, $insert_cat_query);
                if(!$insert_cat_query_result) {
                    die("INSERTION QUERY FAILS" . mysqli_error($connection));
                } else {
                    echo "Category Added";
                }
            }

        }
    }

    function find_all_categories() {
        global $connection;
        $query = "SELECT * FROM categories";
        $all_cat = mysqli_query($connection, $query);
        if(!$all_cat) {
            die("ERROR: GetAllCategories Fails at sidebar.php " . mysqli_error($allCat));
        } 
        if( mysqli_num_rows($all_cat) == 0 ) {
            echo "Empty Table";
        } else { 
            while( $row = mysqli_fetch_assoc($all_cat) ) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                echo "" .
                    "<tr>" .
                        "<td>{$cat_id}</td>" .
                        "<td>{$cat_title}</td>" .
                        "<td> <a href='categories.php?delete={$cat_id}'>Delete</a> </td>".
                        "<td> <a href='categories.php?edit={$cat_id}'>Edit</a> </td>".
                    "</tr>";
            }
        }
    }

    function delete_categories() {
        global $connection;
        if( isset( $_GET['delete'] ) ) {
            $the_cat_id = $_GET['delete'];
            $query ="DELETE FROM categories WHERE cat_id={$the_cat_id}";
            $dlt_query_res = mysqli_query($connection, $query);
            if(!$dlt_query_res) {
                die("DELETE QUERY FAIL: " . mysqli_error($connection) );
            } else {
                header("Location: categories.php");
            }
        }
    }



?>