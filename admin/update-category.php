<?php include("partials/menu.php") ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>

        <?php

        // Check whether the id is set or not
        if (isset($_GET["id"])) {
            //Get ID and all other details
            $id = $_GET["id"];

            //Create SQL Query to get all other details
            $sql = "SELECT * FROM category WHERE id=$id";

            //Execute the Query
            $res = mysqli_query($conn, $sql);

            // Count the Rows to check whether the id is valid or not
            $count = mysqli_num_rows($res);

            if ($count == 1) {
                // Get all the data
                $row = mysqli_fetch_assoc($res);

                $title = $row["title"];
                $current_image = $row["image_name"];
                $featured = $row["featured"];
                $active = $row["active"];
            } else {
                // redirect to manage category with session message
                $_SESSION["no-category-found"] = "<div class='error'>Category not Found.</div>";
                header("location:" . $siteurl . "admin/manage-category.php");
            }
        } else {
            //redirect to Mange Category
            header("location:" . $siteurl . "admin/manage-category.php");
        }

        ?>

        <form action="" method="post" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                        if ($current_image != "") {
                            // Display the Image
                        ?>
                            <img src="<?php echo $siteurl; ?>images/category/<?php echo $current_image; ?>" width="150px">
                        <?php

                        } else {
                            // Display message
                            echo "<div class='error'>Image Not Added.</div>";
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image" value="">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if ($featured == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if ($featured == "No") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if ($active == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if ($active == "No") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>

        <?php
        if (isset($_POST["submit"])) {
            //echo "clicked";

            //Get all the values from form
            $id = $_POST["id"];
            $title = $_POST["title"];
            $current_image = $_POST["current_image"];
            $featured = $_POST["featured"];
            $active = $_POST["active"];

            // Updating New Image if selected
            // Check whether the image is selected or not
            if (isset($_FILES["image"]["name"]) == TRUE) {
                // Get the Image Details
                $image_name = $_FILES["image"]["name"];

                if ($image_name != "") {

                    // Auto Rename our Image
                    //Get the Extension of our image (jpg, png, gif, etc) e.g. "food1.jpg"
                    $ext = end(explode(".", $_FILES["image"]["name"]));

                    // Rename the Image
                    $image_name = "Food_Category_" . rand(000, 999) . "." . $ext; //e.g. Food_Category_830.jpg

                    $source_path = $_FILES["image"]["tmp_name"];

                    $destination_path = "../images/category/" . $image_name;

                    // Finally Upload the Image
                    $upload = move_uploaded_file($source_path, $destination_path);


                    // Check whether the image is uploaded or not
                    // And if the image is not uploaded then we will stop the process and redirect with error message
                    if ($upload == false) {
                        // Set message
                        $_SESSION["upload"] = "<div class='error'>Failed to Upload Image.</div>";

                        header("location:" . $siteurl . "admin/manage-category.php");
                        // Stop the process
                        die();
                    } else {
                        $_SESSION["update"] = "<div class='success'>Category Updated Successfully.</div>";
                    }
                }
                // Remove the Current image if available
                if ($current_image != "") {

                    $remove_path = "../images/category/" . $current_image;

                    $remove = unlink($remove_path);

                    // Check whether the image is removed or not
                    // If failed to remove then display mess and stop the process
                    if ($remove == false) {
                        // Failed to remove image
                        $_SESSION["failed-remove"] = "<div class='error'>Failed to remove current Image.</div>";
                        header("location:" . $siteurl . "admin/manage-category.php");
                        die();
                    }
                }
            } else {
                $image_name = $current_image;
            }

            // Update the Database
            $sql2 = "UPDATE category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
                    WHERE id = '$id'
                ";

            // Execute
            $res2 = mysqli_query($conn, $sql2);

            //Redirect to Manage Category with Mess
            // Check
            if ($res2 == TRUE) {
                // Update
                $_SESSION["update"] = "<div class='success'>Category Updated Successfully.</div>";
                header("location:" . $siteurl . "admin/manage-category.php");
            } else {
                // Failed to Update 
                $_SESSION["update"] = "<div class='error'>Failed to Update Category.</div>";
                header("location:" . $siteurl . "admin/manage-category.php");
            }
        }
        ?>

    </div>
</div>


<?php include("partials/footer.php") ?>