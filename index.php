<?php include("partials-font/menu.php"); ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="<?php echo $siteurl; ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Tìm kiếm đồ ăn.." required>
            <input type="submit" name="submit" value="Tìm" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<br><br>
<?php
if (isset($_SESSION["order"])) {
    echo $_SESSION["order"];
    unset($_SESSION["order"]);
}
?>


<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Các Loại</h2>

        <?php
        // Create SQL Query to Display Categories from
        $sql = "SELECT * FROM category WHERE active='Yes' AND featured = 'Yes' LIMIT 3";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row["id"];
                $title = $row["title"];
                $image_name = $row["image_name"];
        ?>
                <a href="<?php echo $siteurl; ?>category-foods.php?category_id=<?php echo $id; ?>">
                    <div class="box-3 float-container">
                        <?php
                        if ($image_name == "") {
                            // Display the Message 
                            echo "<div class='error'>Image not Available</div>";
                        } else {
                            // Image Available
                        ?>
                            <img src="<?php echo $siteurl; ?>images/category/<?php echo $image_name; ?>" class="img-responsive img-curve">

                        <?php
                        }
                        ?>

                        <h3 class="float-text text-white"><?php echo $title; ?></h3>
                    </div>
                </a>
        <?php
            }
        } else {
            echo "<div class='error'>Category not Added.</div>";
        }
        ?>
        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Món Ăn</h2>

        <?php

        // Getting Foods from DB tha are active and featured
        $sql2 = "SELECT * FROM food WHERE active='Yes' AND featured='Yes' LIMIT 6";

        $res2 = mysqli_query($conn, $sql2);

        $count2 = mysqli_num_rows($res2);

        if ($count2 > 0) {

            while ($row = mysqli_fetch_assoc($res2)) {
                $id = $row["id"];
                $title = $row["title"];
                $price = $row["price"];
                $desciption = $row["description"];
                $image_name1 = $row["image_name"];
        ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        if ($image_name = "") {
                            echo "<div class='error'>Image not available.</div>";
                        } else {
                        ?>
                            <img src="<?php echo $siteurl; ?>images/food/<?php echo $image_name1; ?>" class="img-responsive img-curve">
                        <?php
                        }
                        ?>
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price"><?php echo $price; ?></p>
                        <p class="food-detail">
                            <?php echo $desciption; ?>
                        </p>
                        <br>
                        <a href="<?php echo $siteurl ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Đặt Ngay</a>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "<div class='error'>Food not available.</div>";
        }
        ?>
        <div class="clearfix"></div>


    </div>

    <p class="text-center">
        <a href="<?php echo $siteurl; ?>foods.php">See All Foods</a>
    </p>
</section>
<!-- fOOD Menu Section Ends Here -->

<?php include("partials-font/footer.php"); ?>