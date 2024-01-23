<?php include("partials/menu.php") ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Quán lý món ăn</h1>
        <br>

        <!-- Button to Add Food -->
        <a href="<?php echo $siteurl; ?>admin/add-food.php" class="btn-primary">Add Food</a>
        <br />
        <br />

        <?php
        if (isset($_SESSION["add"])) {
            echo $_SESSION["add"];
            unset($_SESSION["add"]);
        }
        if (isset($_SESSION["unauthorize"])) {
            echo $_SESSION["unauthorize"];
            unset($_SESSION["unauthorize"]);
        }

        if (isset($_SESSION["remove"])) {
            echo $_SESSION["remove"];
            unset($_SESSION["remove"]);
        }

        if (isset($_SESSION["delete"])) {
            echo $_SESSION["delete"];
            unset($_SESSION["delete"]);
        }

        if (isset($_SESSION["upload"])) {
            echo $_SESSION["upload"];
            unset($_SESSION["upload"]);
        }

        if (isset($_SESSION["update"])) {
            echo $_SESSION["update"];
            unset($_SESSION["update"]);
        }
        ?>

        <br>

        <table class="tbl-full">
            <tr>
                <th class="text-center">S.N.</th>
                <th class="text-center">Title</th>
                <th class="text-center">Price</th>
                <th class="text-center">Image</th>
                <th class="text-center">Featured</th>
                <th class="text-center">Active</th>
                <th class="text-center">Actions</th>
            </tr>

            <?php
            //Create a SQL Query to Get all the food
            $sql = "SELECT * FROM food";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            $sn = 1;

            if ($count > 0) {

                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row["id"];
                    $title = $row["title"];
                    $price = $row["price"];
                    $image_name = $row["image_name"];
                    $featured = $row["featured"];
                    $active = $row["active"];
            ?>
                    <tr>
                        <td class="text-center"><?php echo $sn++; ?> </td>
                        <td class="text-center"><?php echo $title; ?></td>
                        <td class="text-center"><?php echo $price; ?></td>
                        <td class="text-center">
                            <?php
                            //Check whether we have image or not
                            if ($image_name != "") {

                                // Display the Image
                            ?>

                                <img src="<?php echo $siteurl; ?>images/food/<?php echo $image_name; ?>" width="100px">

                            <?php

                            } else {
                                // Display the message
                                echo "<div class='error'>Image not Added.</div>";
                            }
                            ?>
                        </td>
                        <td class="text-center"><?php echo $featured; ?></td>
                        <td class="text-center"><?php echo $active; ?></td>
                        <td class="text-center">
                            <a href="<?php echo $siteurl; ?>admin/update-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-secondary">Update</a>
                            <a href="<?php echo $siteurl; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete</a>
                        </td>
                    </tr>

            <?php
                }
            } else {
                echo "<tr> <td colspan='7' class='error'> Food not Added yet. </td> </tr>";
            }
            ?>
        </table>
    </div>
</div>

<?php include("partials/footer.php") ?>