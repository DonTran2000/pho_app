<?php include("partials/menu.php") ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>

        <?php
        if (isset($_SESSION["upload"])) {
            echo $_SESSION["upload"];
            unset($_SESSION["upload"]);
        }
        ?>

        <form action="" method="post" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the food">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the food"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>

                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                            <?php

                            // Create PHP code to display categories from DB
                            // 1. Create SQL to get all active categories from DB
                            $sql = "SELECT * FROM category WHERE active='Yes'";

                            $res = mysqli_query($conn, $sql);

                            $count = mysqli_num_rows($res);

                            if ($count > 0) {

                                while ($row = mysqli_fetch_assoc($res)) {
                                    $id = $row["id"];
                                    $title = $row["title"];

                            ?>

                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                <?php
                                }
                            } else {
                                ?>
                                <option value="0">No Category</option>
                            <?php
                            }

                            // 2. Display on Dropdown                    
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>

                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>

                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php

        // Check whether the button is clicked or not 
        if (isset($_POST["submit"])) {

            // 1. Get the Data from form
            $title = $_POST["title"];
            $description = $_POST["description"];
            $price = $_POST["price"];
            $category = $_POST["category"];
            $featured = $_POST["featured"];

            if (isset($_POST["featured"])) {
                $featured = $_POST["featured"];
            } else {
                $featured = "No";
            }

            $active = $_POST["active"];

            if (isset($_POST["active"])) {
                $active = $_POST["active"];
            } else {
                $active = "No";
            }

            // 2. Upload the Image if selected
            // Check whether the select image is clicked or not and upload the image only if the image is selected
            if (isset($_FILES["image"]["name"])) {

                $image_name = $_FILES["image"]["name"];


                if ($image_name != "") {
                    // A. Rename the Image
                    // Get extension of selected image (jpg, png, gif,...)
                    $ext = explode(".", $image_name);

                    // Create New Name for Image
                    $image_name = "Food-name-" . rand(0000, 9999) . "." . $ext[1];

                    // B. Upload the Image
                    // Get the src Path and Destination path

                    // Source path is the current location of the image
                    $src = $_FILES["image"]["tmp_name"];


                    // Destination Path for the image to be uploaded
                    $folder = "../images/food/";
                    $dst = $folder . $image_name;

                    // Finally Upload the food image
                    $upload = move_uploaded_file($src, $dst);



                    // Check whether image uploaded or not
                    if ($upload == false) {

                        $_SESSION["upload"] = "<div class='error'>Failed to Upload Image.</div>";

                        header("location:" . $siteurl . "admin/add-food.php");

                        die();
                    }
                }
            } else {
                $image_name = "";
            }

            // 3. Insert into DB

            $sql2 = "INSERT INTO food SET
                title = '$title',
                description = '$description',
                price = $price,
                image_name = '$image_name',
                category_id = $category,
                featured = '$featured',
                active = '$active'
            ";

            $res2 = mysqli_query($conn, $sql2);

            if ($res2 == true) {
                $_SESSION["add"] = "<div class='success'>Food Added Successfully.</div>";
                header("location:" . $siteurl . "admin/manage-food.php");
            } else {
                $_SESSION["add"] = "<div class='erro'>Failed to Add Food.</div>";
                header("location:" . $siteurl . "admin/manage-food.php");
            }
        }

        ?>
    </div>
</div>

<?php include("partials/footer.php") ?>