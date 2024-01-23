<?php include("partials/menu.php") ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>

        <?php
        if (isset($_SESSION["add"])) {
            echo $_SESSION["add"];
            unset($_SESSION["add"]);
        }
        if (isset($_SESSION["upload"])) {
            echo $_SESSION["upload"];
            unset($_SESSION["upload"]);
        }
        ?>
        <br>

        <!-- Add Category Form Starts -->
        <form action="" method="post" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
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
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
        <!-- Add Category Form Ends -->
    </div>
</div>

<?php include("partials/footer.php") ?>

<?php

//Check whether the Submit Button is Clicked or not
if (isset($_POST["submit"])) {

    $title = $_POST["title"];

    // For Radio input, we need to check whether the button is selected or not
    if (isset($_POST["featured"])) {

        //Get the value from form
        $featured = $_POST["featured"];
    } else {
        // Set the Default value
        $featured = "No";
    }

    if (isset($_POST["active"])) {
        $active = $_POST["active"];
    } else {
        $active = "No";
    }

    // Check whether the image is selected or not and set the value for image name accordingly
    // print_r($_FILES["image"]);

    // die(); //Break the Code Here

    if (isset($_FILES["image"]["name"])) {
        // Upload the Image
        // To upload image we need image name, source path and destination path
        $image_name = $_FILES["image"]["name"];

        // Upload the Image only if image is selected
        if ($image_name != "") {

            // Auto Rename our Image
            //Get the Extension of our image (jpg, png, gif, etc) e.g. "food1.jpg"
            $ext = end(explode(".", $image_name));

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

                header("location:" . $siteurl . "admin/add-category.php");
                // Stop the process
                die();
            }
        }
    } else {
        // Don't Upload Image and set the image_name value as blank
        $image_name = "";
    }

    //Create SQL Query to Insert Category into Database
    $sql = "INSERT INTO category (title, image_name ,featured, active) 
                    VALUES ('$title', '$image_name' ,'$featured', '$active')";

    $res = mysqli_query($conn, $sql);

    //Check
    if ($res == TRUE) {
        $_SESSION["add"] = "<div class='success'>Category Added Successfully.</div>";
        header("location:" . $siteurl . "admin/manage-category.php");
    } else {
        $_SESSION["add"] = "<div class='error'>Failed to Add Category.</div>";
        header("location:" . $siteurl . "admin/add-category.php");
    }
}
mysqli_close($conn);
?>