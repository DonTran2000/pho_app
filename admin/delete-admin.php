
<?php

    include("../config/database.php");

    //1. get the Id of Admin to be deleted
    $id = $_GET["id"];

    //2. Create SQL Query to Delete Admin
    $sql = "DELETE FROM admin WHERE id=$id";

    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //Check
    if ($res == TRUE) {
        // Query Executed Successfully and Admin Deleted
        //echo "Admin Deleted";
        //Crete Session Variable to Dislay Message
        $_SESSION["delete"] = "<div class='success'>Admin Deleted Successfully.</div>";
        //Redirect to Manage Admin Page
        header("location:".$siteurl."admin/manage-admin.php");
    }
    else {
        // Failed to Delete Admin
        //echo "Failed to Delete Admin";
        $_SESSION["delete"] = "<div class='error'>Failed to Delete Admin.</div>";
        header("location:".$siteurl."admin/manage-admin.php");
    }

    //3. Redirect to Manage Admin page with message ()
?>
