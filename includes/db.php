<?php

    $db['db_host'] = "localhost";
    $db['db_user'] = "root";
    $db['db_pass'] = "";
    $db['db_name'] = "cms";

    foreach( $db as $key => $value ) {
        define(strtoupper($key), $value); //CONSTANTS Eg: EB_HOST = "localhost";
    }

    $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if(!$connection) {
        die("DATABASE CONNECTION FAILS");
    }

    $query = "SET NAMES utf8";
    mysqli_query($connection, $query);
?>