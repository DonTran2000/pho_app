<?php

    session_start();

    $siteurl = "http://localhost/website/";
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "pho_app";
    $conn = "";

    try {
        $conn = mysqli_connect($db_server,$db_user,$db_pass,$db_name);
        mysqli_set_charset($conn, "utf8");
    }
    catch(mysqli_sql_exception) {
        echo"Could not connect! <br>";
    }
?>