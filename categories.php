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

<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Tất cả các loại</h2>


        <?php

        //Display all the categories thar are active
        $sql = "SELECT * FROM category WHERE active='Yes'";

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
                            echo "<div>Image not Added</div>";
                        } else {
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
            echo "<div class='error'>Category not found.</div>";
        }

        ?>


        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<?php include("partials-font/footer.php"); ?>