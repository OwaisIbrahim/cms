
<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>FirstName</th>
            <th>LastName</th>
            <th>Email</th>
            <th>Role</th>
            <th>Date</th>
            <th>Allow</th>
            <th>Not Allow</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php  
            $query = "SELECT * FROM users";
            $all_users = mysqli_query($connection, $query);
            while( $row = mysqli_fetch_assoc($all_users) ) {
                $user_id = $row['user_id'];
                $user_username = $row['user_username'];
                $user_firstname = $row['user_firstname'];
                $user_lastname = $row['user_lastname'];
                $user_email = $row['user_email'];
                $user_role = $row['user_role'];
                $user_image = $row['user_image'];
                
                echo "<tr>";
                    echo "<td>{$user_id}</td>"; 
                    echo "<td>{$user_username}</td>";
                    echo "<td>{$user_firstname}</td>";
                    echo "<td>{$user_lastname}</td>";
                    echo "<td>{$user_email}</td>";
                    echo "<td>{$user_role}</td>";
                    echo "<td> USER DATE HERE </td>";
                      
                    // $cat_name_query = "SELECT * FROM categories WHERE cat_id={$post_cat_id}";
                    // $cat_name_query_res = mysqli_query($connection, $cat_name_query);
                    // confirm_query($cat_name_query_res);
                    // while($row = mysqli_fetch_assoc($cat_name_query_res)) {
                    //     $cat_title = $row['cat_title'];
                    //     echo "<td>{$cat_title}</td>";
                    // } 
                    
                    // $query = "SELECT * FROM posts WHERE post_id=$comment_post_id";
                    // $select_post_by_id = mysqli_query($connection, $query);

                    // while($row = mysqli_fetch_assoc($select_post_by_id) ) {
                    //     $post_id = $row['post_id'];
                    //     $post_title = $row['post_title'];
                    //     echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
                    // }

                    echo "<td><a href='users.php?change_to_admin={$user_id}'>Admin</a></td>";
                    echo "<td><a href='users.php?change_to_subscriber={$user_id}'>Subscriber</a></td>";
                    echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
                    echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>

<?php
    //DELETE POST
    if( isset( $_GET['delete'] ) ) {
        if( isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
            $the_post_id = mysqli_real_escape_string($connection, $_GET['delete']);
            $the_user_id = $_GET['delete'];
            $query = "DELETE FROM users WHERE user_id = $the_user_id";
            $delete_query = mysqli_query($connection, $query);
            confirm_query($delete_query);
            header('Location: users.php');
        }
    }

    
    //MAKE TO ADMIN
    if( isset( $_GET['change_to_admin'] ) ) {
        $the_user_id = $_GET['change_to_admin'];
        $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $the_user_id";
        $make_admin_query = mysqli_query($connection, $query);
        confirm_query($make_admin_query);
        header('Location: users.php');
    }
    
    //UNAPPROVE POST
    if( isset( $_GET['change_to_subscriber'] ) ) {
        $the_user_id = $_GET['change_to_subscriber'];
        $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $the_user_id";        
        $make_subscriber_query = mysqli_query($connection, $query);
        confirm_query($make_subscriber_query);
        header('Location: users.php');
    }
?>