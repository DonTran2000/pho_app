<?php include("partials-font/menu.php"); ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="<?php echo $siteurl; ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Tìm kiếm món ăn.." required>
            <input type="submit" name="submit" value="Tìm" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Món Ăn</h2>

        <?php

        //Display Foods that are Active
        $sql = "SELECT * FROM food WHERE active='Yes'";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if ($count > 0) {

            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row["id"];
                $title = $row["title"];
                $price = $row["price"];
                $description = $row["description"];
                $image_name = $row["image_name"];

        ?>

                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php

                        if ($image_name == "") {
                            echo "<div class='error'>Image not available.</div>";
                        } else {
                        ?>
                            <img src="<?php echo $siteurl; ?>images/food/<?php echo $image_name; ?>" class="img-responsive img-curve">

                        <?php
                        }
                        ?>
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price"><?php echo $price; ?></p>
                        <p class="food-detail">
                            <?php echo $description; ?>
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

</section>
<!-- fOOD Menu Section Ends Here -->

<?php include("partials-font/footer.php"); ?>