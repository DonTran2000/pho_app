<?php

include("../config/database.php");

if (isset($_POST["orders_delete_multiple_btn"])) {
    $all_id = $_POST["orders_delete_id"];
    $extract_id = implode(',', $all_id);

    // echo $extract_id; die();

    $sql2 = "DELETE FROM orders WHERE id IN($extract_id) ";

    $res2 = mysqli_query($conn, $sql2);

    if ($res2 == true) {
        $_SESSION["new"] = "<div class='success'>Xoá thành công.</div>";
        header("location:" . $siteurl . "admin/manage-order.php");
    } else {
        $_SESSION["new"] = "<div class='success'>Xoá thất bại.</div>";
        header("location:" . $siteurl . "admin/manage-order.php");
    }
}
