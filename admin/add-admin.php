<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br>

        <?php
        if (isset($_SESSION["add"])) {
            echo $_SESSION["add"];
            unset($_SESSION["add"]);
        }
        ?>

        <form action="add-admin.php" method="post">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Your Username">
                    </td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include("partials/footer.php") ?>

<?php
//Process the Value from Form and Save it in Database
if (isset($_POST["submit"])) {
    // echo "Button Clicked";

    //1. Get the Data from form
    $full_name = $_POST["full_name"];
    $username = $_POST["username"];
    $password = md5($_POST["password"]); //password encryption

    //2. SQL Query to Save the data into Database
    $sql = "INSERT INTO admin (full_name, username, password) 
            VALUES ('$full_name', '$username', '$password')";
    //3. Execute Query and Save Data in Database

    $res = mysqli_query($conn, $sql);

    if ($res == TRUE) {

        $_SESSION["add"] = "<div class='success'>Admin Added Successfully.</div>";

        header("location:" . $siteurl . "admin/manage-admin.php");
    } else {
        $_SESSION["add"] = "<div class='error'>Failed to Add Admin.</div>";

        header("location:" . $siteurl . "admin/add-admin.php");
    }
} else {
}
mysqli_close($conn);

?>