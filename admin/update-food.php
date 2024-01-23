<?php include("partials/menu.php") ?>

<?php
// Check whether id is set or not
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $sql2 = "SELECT * FROM food WHERE id=$id";

    $res = mysqli_query($conn, $sql2);

    $count = mysqli_num_rows($res);

    $row2 = mysqli_fetch_assoc($res);

    $title = $row2["title"];
    $description = $row2["description"];
    $price = $row2["price"];
    $current_image = $row2["image_name"];
    $current_category = $row2["category_id"];
    $featured = $row2["featured"];
    $active = $row2["active"];
} else {
    header("location:" . $siteurl . "admin/manage-food.php");
}

?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>


        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">

                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                        if ($current_image == "") {
                            echo "<div class='error'>Image not Available.</div>";
                        } else {
                        ?>
                            <img src="<?php echo $siteurl; ?>images/food/<?php echo $current_image; ?>" width="200px">
                        <?php
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Select New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                            <?php
                            $sql = "SELECT * FROM category WHERE active='Yes'";

                            $res = mysqli_query($conn, $sql);

                            $count = mysqli_num_rows($res);

                            if ($count > 0) {

                                while ($row = mysqli_fetch_assoc($res)) {
                                    $category_id = $row["id"];
                                    $category_title = $row["title"];

                                    //echo "<option value='$category_id'>$category_title</option>";
                            ?>

                                    <option <?php if ($current_category == $category_id) {
                                                echo "selected";
                                            } ?> value="<?php echo $category_id ?>"><?php echo $category_title ?></option>

                            <?php
                                }
                            } else {
                                echo "<option value='0'>Category Not Available.</option>";
                            }

                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if ($featured == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if ($featured == "No") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if ($active == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="Yes">Yes
                        <input <?php if ($active == "No") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php

        if (isset($_POST["submit"])) {

            // 1. Get all the details from the form
            $id = $_POST["id"];
            $title = $_POST["title"];
            $description = $_POST["description"];
            $price = $_POST["price"];
            $current_image = $_POST["current_image"];
            $category = $_POST["category"];

            $featured = $_POST["featured"];
            $active = $_POST["active"];


            // 2.Upload the image if selected

            // Check whether upload button is clicked or not
            if (isset($_FILES["image"]["name"])) {

                $image_name = $_FILES["image"]["name"]; // New Image name

                if ($image_name != "") {
                    // Auto Rename our Image
                    //Get the Extension of our image (jpg, png, gif, etc) e.g. "food1.jpg"
                    $ext = end(explode(".", $_FILES["image"]["name"]));

                    // Rename the Image
                    $image_name = "Food-Name-" . rand(000, 999) . "." . $ext; //e.g. Food_Category_830.jpg

                    $source_path = $_FILES["image"]["tmp_name"];

                    $destination_path = "../images/food/" . $image_name;

                    // Finally Upload the Image
                    $upload = move_uploaded_file($source_path, $destination_path);


                    // Check whether the image is uploaded or not
                    // And if the image is not uploaded then we will stop the process and redirect with error message
                    if ($upload == false) {
                        // Set message
                        $_SESSION["upload"] = "<div class='error'>Failed to Upload Image.</div>";

                        header("location:" . $siteurl . "admin/manage-food.php");
                        // Stop the process
                        die();
                    }
                    // 3. Remove the image if new image is uploaded and current image exists
                    if ($current_image != "") {
                        $remove_path = "../images/food/" . $current_image;
                        $remove = unlink($remove_path);

                        //Check whether the image is removed or not
                        if ($remove == false) {
                            // Failed to remove current image
                            $_SESSION["remove-failed"] = "<div class='error'>Failed to remove current image.</div>";
                            header("location:" . $siteurl . "admin/manage-food.php");
                            die();
                        }
                    }
                } else {
                    $image_name = $current_image;   // Default Image when Image is not Selected
                }
            } else {
                $image_name = $current_image;   //Default Image when Button is not Clicked
            }


            // 4. Update the Food in DB
            $sql3 = "UPDATE food SET
                title = '$title',
                description = '$description',
                price = '$price',
                image_name = '$image_name',
                category_id = $category,
                featured = '$featured',
                active = '$active'
                WHERE id= $id
            ";

            $res3 = mysqli_query($conn, $sql3);

            // Redirect to Manage Food with Session Message
            if ($res3 == true) {
                $_SESSION["update"] = "<div class='success'>Food Updated Successfully.</div>";
                header("location:" . $siteurl . "admin/manage-food.php");
            } else {
                $_SESSION["update"] = "<div class='erro'>Failed to Update Food..</div>";
                header("location:" . $siteurl . "admin/manage-food.php");
            }
        }
        ?>
    </div>
</div>

<?php include("partials/footer.php") ?>