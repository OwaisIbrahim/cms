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
        //echo $result;       
        if( !$result ) {
            die("QUERY FAILED: " . mysqli_error($connection) );
        }
    }

    function insert_categories() {
        global $connection;
        if( isset($_POST['submit']) ) {
            $cat_title = $_POST['cat_title'];
            
            if($cat_title == "" || empty($cat_title)) {
                echo "This field should not be empty";
            } else {
                /*
                $insert_cat_query = "INSERT INTO categories(cat_title) ";
                $insert_cat_query .= "VALUE('{$cat_title}') ";
                $insert_cat_query_result = mysqli_query($connection, $insert_cat_query);
                */
                $stmt = mysqli_prepare($connection, "INSERT INTO categories(cat_title) VALUES(?) ");
                mysqli_stmt_bind_param($stmt, 's', $cat_title);
                mysqli_stmt_execute($stmt);
                if(!$stmt) {
                    die("INSERTION QUERY FAILS" . mysqli_error($connection));
                } else {
                    echo "Category Added";
                }
            }
            mysqli_stmt_close($stmt);
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

    function record_count($table_name) {
        
        global $connection;
        $query = "SELECT * FROM " . $table_name;
        $select_all_posts = mysqli_query($connection, $query);
        $result = mysqli_num_rows($select_all_posts);
        confirm_query($result);
        return $result;
    }

    function check_status($table_name, $col_name, $status) {
        global $connection;
        $query = "SELECT * FROM $table_name WHERE $col_name = '$status'";
        $select_all_posts = mysqli_query($connection, $query);
        $result = mysqli_num_rows($select_all_posts);
        return $result;
    }

    function is_admin($username = '') {
        global $connection;
        $query = "SELECT user_role FROM users WHERE user_username='{$username}'";
        $result = mysqli_query($connection, $query);
        confirm_query($result);
        $row = mysqli_fetch_array($result);
        if( $row['user_role'] == "admin" )
            return true;
        else
            return false;
    }

    function is_user_exist($username = '') {
        global $connection;
        $query = "SELECT * FROM users WHERE user_username='{$username}'";
        $result = mysqli_query($connection, $query);
        confirm_query($result);
        if( mysqli_num_rows($result) > 0 ) 
            return true;
        else
            return false;
    }

    function is_email_exist($email = '') {
        global $connection;
        $query = "SELECT * FROM users WHERE user_email='{$email}'";
        $result = mysqli_query($connection, $query);
        confirm_query($result);
        if( mysqli_num_rows($result) > 0 ) 
            return true;
        else
            return false;
    }

    function redirect($location) {
        return header("Location: " . $location);
        exit;
    }

    function ifItIsMethod( $method = null ) {
        if( $_SERVER['REQUEST_METHOD'] == strtoupper($method) ) {
            return true;
        }
        return false;
    }

    function isLoggedIn() {
        if( isset( $_SESSION['user_role'] ) ) {
            return true;
        }
        return false;
    }

    function checkIfUserIsLoggedInAndRedirect( $redirectLocation = null ) {
        if( isLoggedIn() ) {
            redirect($redirectLocation);
        }
    }

    function register_user($username, $email, $password) {
        global $connection;
        
            $username =  mysqli_real_escape_string($connection, $username);
            $email =  mysqli_real_escape_string($connection, $email);
            $password =  mysqli_real_escape_string($connection, $password);

            $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));

            $query = "INSERT INTO users (user_username, user_email, user_password, user_role) ";
            $query .= "VALUES('{$username}', '{$email}', '{$password}', 'subscriber') ";
            $register_user_query = mysqli_query($connection, $query);

            confirm_query($register_user_query);
    }

    function login_user($username, $password) {
        global $connection;

        $username = trim(mysqli_real_escape_string($connection, $username));
        $password = trim(mysqli_real_escape_string($connection, $password));

        $query = "SELECT * FROM users WHERE user_username = '{$username}' ";
        $select_user_query = mysqli_query($connection, $query);

        if( !$select_user_query ) {
            die("QUERY FAILED: " . mysqli_error($connection) );
        }

        while( $row = mysqli_fetch_array($select_user_query) ) {
            $db_user_id = $row['user_id'];
            $db_user_username = $row['user_username'];
            $db_user_password = $row['user_password'];
            $db_user_firstname = $row['user_firstname'];
            $db_user_lastname = $row['user_lastname'];
            $db_user_role = $row['user_role'];

            
            if( password_verify($password, $db_user_password) ) {
                $_SESSION['user_id'] = $db_user_id;
                $_SESSION['user_username'] = $db_user_username;
                $_SESSION['user_firstname'] = $db_user_firstname;
                $_SESSION['user_lastname'] = $db_user_lastname;
                $_SESSION['user_role'] = $db_user_role;
                if($db_user_role == 'admin')
                    redirect("/cms/admin");
                else
                    return false;

            } else {
                return false; 

            }
            // $password = crypt($password, $db_user_password);
        }
        return true;

    }

?>