<?php include("config/database.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phở Việt</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="<?php $siteurl; ?>" title="Logo">
                    <img src="images/logopho.png" alt="Pho Logo" class="img-responsive" style="width: 80px;">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo $siteurl; ?>">Trang Chủ</a>
                    </li>
                    <li>
                        <a href="<?php echo $siteurl; ?>categories.php">Loại</a>
                    </li>
                    <li>
                        <a href="<?php echo $siteurl; ?>foods.php">Món Ăn</a>
                    </li>
                    <li>
                        <a href="#">Liên Hệ</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->