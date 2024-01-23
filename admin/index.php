<?php include("partials/menu.php"); ?>

<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Bảng Tổng Thể</h1>

        <br><br>

        <?php
        if (isset($_SESSION["login"])) {
            echo $_SESSION["login"];
            unset($_SESSION["login"]);
        }
        ?>
        <br><br>

        <div class="col-4 text-center">

            <?php

            $sql = "SELECT * FROM category";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);
            ?>

            <h1><?php echo $count; ?></h1>
            <br>
            Các Loại
        </div>
        

        <div class="col-4 text-center">

            <?php

            $sql = "SELECT * FROM food";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);
            ?>

            <h1><?php echo $count; ?></h1>
            <br>
            Các Món
        </div>

        <div class="col-4 text-center">

            <?php

            $sql = "SELECT * FROM orders";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);
            ?>

            <h1><?php echo $count; ?></h1>
            <br>
            Tổng đơn đặt hàng
        </div>

        <div class="col-4 text-center">

            <?php

            $sql = "SELECT SUM(total) AS Total FROM orders WHERE status='Đã xong'";

            $res = mysqli_query($conn, $sql);

            $row = mysqli_fetch_assoc($res);

            $total_revenue = $row["Total"];
            ?>

            <h1><?php echo $total_revenue; ?></h1>
            <br>
            Doanh Thu
        </div>

        <div class="clearfix">

        </div>
    </div>
</div>
<!-- Main Content Section End -->

<?php include("partials/footer.php"); ?>