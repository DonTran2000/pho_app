<?php

    include("../config/database.php");

    //1. Destory the Session
    session_destroy(); // Unsets $_SESSION["user"]

    //2. Redirect to Login page
    header("location:".$siteurl."admin/login.php");
?>