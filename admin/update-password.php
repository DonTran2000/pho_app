<?php include("partials/menu.php") ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
        }
        ?>
        <form action="" method="post">

            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>

                <tr>
                    <td>New Password: </td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>

    </div>
</div>

<?php

//Check whether the submit Button is Clicked on Not
if (isset($_POST["submit"])) {

    //echo "Clicked";

    // 1. Get the Data from Form
    $id = $_POST["id"];
    $current_password = md5($_POST["current_password"]);
    $new_password = md5($_POST["new_password"]);
    $confirm_password = md5($_POST["confirm_password"]);

    // 2. Check whether the user with current ID and Current Password Exists or Not
    $sql = "SELECT * FROM admin WHERE id=$id AND password='$current_password'";

    // Execute the Query
    $res = mysqli_query($conn, $sql);

    if ($res == TRUE) {
        //Check whether data is available or not
        $count = mysqli_num_rows($res);

        if ($count == 1) {
            //User Exists and Password Can be Changed
            //echo "User Found";

            //Check whether the new password and confirm match or not
            if ($new_password == $confirm_password) {

                //Update the Password
                //echo "Pass Match";
                $sql2 = "UPDATE admin SET 
                    password='$new_password'
                    WHERE id=$id
                ";

                // Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //Check whether the Query or not
                if ($res2 == true) {
                    // Display Success Message
                    $_SESSION["change-pwd"] = "<div class='success'>Password Changed Successfully.</div>";
                    header("location:" . $siteurl . "admin/manage-admin.php");
                } else {
                    // Display Erro Message
                    $_SESSION["change-pwd"] = "<div class='error'>Failed Change Password.</div>";
                    header("location:" . $siteurl . "admin/manage-admin.php");
                }
            } else {
                $_SESSION["pwd-not-match"] = "<div class='error'>Password did Not Match !</div>";
                //Redirect update-password Page
                header("location:" . $siteurl . "admin/manage-admin.php");
            }
        } else {
            // User Does not Exist Set Message and Redirect
            $_SESSION["user-not-found"] = "<div class='error'>User Not Found !</div>";

            header("location:" . $siteurl . "admin/manage-admin.php");
        }
    }

    // 3. Check whether the New Password and Confirm Password Match or Not

    // 4. Chang Password if all above is true
}

?>


<?php include("partials/footer.php") ?>