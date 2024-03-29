<?php include("partials/menu.php") ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Quán lý loại món</h1>

        <br><br>

        <?php
        if (isset($_SESSION["add"])) {
            echo $_SESSION["add"];
            unset($_SESSION["add"]);
        }

        if (isset($_SESSION["remove"])) {
            echo $_SESSION["remove"];
            unset($_SESSION["remove"]);
        }

        if (isset($_SESSION["delete"])) {
            echo $_SESSION["delete"];
            unset($_SESSION["delete"]);
        }

        if (isset($_SESSION["no-category-found"])) {
            echo $_SESSION["no-category-found"];
            unset($_SESSION["no-category-found"]);
        }

        if (isset($_SESSION["update"])) {
            echo $_SESSION["update"];
            unset($_SESSION["update"]);
        }

        if (isset($_SESSION["upload"])) {
            echo $_SESSION["upload"];
            unset($_SESSION["upload"]);
        }

        if (isset($_SESSION["failed-remove"])) {
            echo $_SESSION["failed-remove"];
            unset($_SESSION["failed-remove"]);
        }
        ?>

        <br><br>


        <!-- Button to Add Catagory -->
        <a href="<?php echo $siteurl ?>admin/add-category.php" class="btn-primary">Thêm Loại</a>
        <br />
        <br />

        <table class="tbl-full">
            <tr>
                <th>Số</th>
                <th>Tên</th>
                <th>Hình</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php

            $sql = "SELECT * FROM category";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            // Create Serial Number Variable and assign as 1
            $sn = 1;

            if ($count > 0) {

                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row["id"];
                    $title = $row["title"];
                    $image_name = $row["image_name"];
                    $featured = $row["featured"];
                    $active = $row["active"];
            ?>

                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title; ?></td>

                        <td>
                            <?php
                            //Check whether image name is vailable or not
                            if ($image_name != "") {

                                // Display the Image
                            ?>

                                <img src="<?php echo $siteurl; ?>images/category/<?php echo $image_name; ?>" width="100px">

                            <?php

                            } else {
                                // Display the message
                                echo "<div class='error'>Image not Added.</div>";
                            }
                            ?>
                        </td>

                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                            <a href="<?php echo $siteurl; ?>admin/update-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-secondary">Update</a>
                            <a href="<?php echo $siteurl; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete</a>
                        </td>
                    </tr>

                <?php
                }
            } else {
                ?>

                <tr>
                    <td colspan="6">
                        <div class="error text-center">No Category Added.</div>
                    </td>
                </tr>

            <?php
            }
            ?>
        </table>
    </div>
</div>

<?php include("partials/footer.php") ?>