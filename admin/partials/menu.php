<?php
    include("../config/database.php");
    include("login-check.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phở Việt (Chủ Quán)</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <!-- Menu Section Starts -->
    <div class="menu text-center">
        <div class="wrapper">
            <ul>
                <li><a href="index.php">Trang Chủ</a></li>
                <li><a href="manage-admin.php">Chủ Quán</a></li>
                <li><a href="manage-category.php">Loại</a></li>
                <li><a href="manage-food.php">Món</a></li>
                <li><a href="manage-order.php">Đơn Hàng</a></li>
                <li><a href="logout.php">Thoát</a></li>
            </ul>
        </div>
    </div>
    <!-- Menu Section End -->