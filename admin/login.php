<?php include("../config/database.php") ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Đăng Nhập</title>
</head>

<body>

    <div class="login">
        <h1 class="text-center">Login</h1>
        <br><br>

        <?php

        if (isset($_SESSION["login"])) {
            echo $_SESSION["login"];
            unset($_SESSION["login"]);
        }

        if (isset($_SESSION["no-login-message"])) {
            echo $_SESSION["no-login-message"];
            unset($_SESSION["no-login-message"]);
        }
        ?>

        <br><br>

        <!-- Login form Starts Here -->
        <form action="" method="post" class="text-center">
            Tên: <br>
            <input type="text" name="username" placeholder="Tên"><br>
            Mật Khẩu: <br>
            <input type="password" name="password" placeholder="Mật Khẩu"><br><br>

            <input type="submit" name="submit" value="Đăng Nhập" class="btn-primary">
        </form>
        <!-- Login form Ends Here -->
        <br>

        <p class="text-center">Created By - <a href="#">Don</a></p>
    </div>

</body>

</html>

<?php
//Check whether the Submit Button is Clicked or not
if (isset($_POST["submit"])) {

    // Process for Login
    // 1. Get the Data from Login form
    // $username = $_POST["username"];
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    // $password = md5($_POST["password"]);
    $password = mysqli_real_escape_string($conn, md5($_POST["password"]));

    // 2.SQL to check whether the user with username and password exists or not
    $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";

    // 3. Execute the Query
    $res = mysqli_query($conn, $sql);

    // 4. Count rows to check the user exists or not
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        // Login Success
        $_SESSION["login"] = "<div class='success'>Login Successful.</div>";
        $_SESSION["user"] = $username; // To check whether the user is logged in or not and logout will unset it

        //Redirect to Home Page/Dashboard
        header("location:" . $siteurl . "admin/");
    } else {
        // Users not Available
        $_SESSION["login"] = "<div class='error text-center'>Username or Password did Not Matched !</div>";
        header("location:" . $siteurl . "admin/login.php");
    }
}
?>