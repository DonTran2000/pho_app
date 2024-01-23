<?php

include("..//config/database.php");

if (isset($_GET["id"]) and isset($_GET["image_name"])) {

    // echo "delete";

    $id = $_GET["id"];
    $image_name = $_GET["image_name"];

    // Remove the physical image file is available
    if ($image_name != "") {

        $path = "../images/category/" . $image_name;

        $remove = unlink($path);

        if ($remove == false) {

            $_SESSION["remove"] = "<div class='error'>Failed to Remove Category Image.</div>";

            header("location:" . $siteurl . "admin/manage-category.php");

            die();
        }
    }

    $sql = "DELETE FROM category WHERE id=$id";

    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION["delete"] = "<div class='success'>Category Deleted Successfully.</div>";
        header("location:" . $siteurl . "admin/manage-category.php");
    } else {
        $_SESSION["delete"] = "<div class='error'>Failed to Delete Category.</div>";
        header("location:" . $siteurl . "admin/manage-category.php");
    }
} else {
    header("location:" . $siteurl . "admin/manage-category.php");
}

?>