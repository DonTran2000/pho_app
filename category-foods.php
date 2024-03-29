<?php include("partials-font/menu.php"); ?>

<?php

// Check whether id is passed or not 
if (isset($_GET["category_id"])) {
    // Category id is set and get the id
    $category_id = $_GET["category_id"];

    // Get the Category Title Based on Category Id
    $sql = "SELECT title FROM category WHERE id=$category_id";

    $res = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($res);

    $category_title = $row["title"];
} else {
    // Category not passed
    header("location:" . $siteurl);
}

?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Tất cả các món ăn</h2>

        <?php

        // Create SQL Query to Get foods based on Selected Category
        $sql2 = "SELECT * FROM food WHERE category_id=$category_id";

        $res2 = mysqli_query($conn, $sql2);

        $count2 = mysqli_num_rows($res2);

        if ($count2 > 0) {

            while ($row2 = mysqli_fetch_assoc($res2)) {
                $id = $row2["id"];
                $title = $row2["title"];
                $description = $row2["description"];
                $price = $row2["price"];
                $image_name = $row2["image_name"];

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

                        <a href="<?php echo $siteurl ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Đặt ngay</a>
                    </div>
                </div>
        <?php

            }
        } else {
            echo "<div class='error'>Food not Available.</div>";
        }


        ?>




        <div class="clearfix"></div>



    </div>

</section>
<!-- fOOD Menu Section Ends Here -->

<?php include("partials-font/footer.php"); ?>