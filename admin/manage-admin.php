<?php include("partials/menu.php"); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Quản Lý</h1>
        <br />


        <?php
        if (isset($_SESSION["add"])) {
            echo $_SESSION["add"];  //Displaying Session Message
            unset($_SESSION["add"]); //Removing Session Message
        }

        if (isset($_SESSION["delete"])) {
            echo $_SESSION["delete"];
            unset($_SESSION["delete"]);
        }

        if (isset($_SESSION["update"])) {
            echo $_SESSION["update"];
            unset($_SESSION["update"]);
        }

        if (isset($_SESSION["user-not-found"])) {
            echo $_SESSION["user-not-found"];
            unset($_SESSION["user-not-found"]);
        }

        if (isset($_SESSION["pwd-not-match"])) {
            echo $_SESSION["pwd-not-match"];
            unset($_SESSION["pwd-not-match"]);
        }

        if (isset($_SESSION["change-pwd"])) {
            echo $_SESSION["change-pwd"];
            unset($_SESSION["change-pwd"]);
        }
        ?>
        <br><br>

        <!-- Button to Add Admin -->
        <a href="add-admin.php" class="btn-primary">Thêm Thành Viên</a>
        <br />
        <br />

        <table class="tbl-full">
            <tr>
                <th>Số</th>
                <th>Họ Tên</th>
                <th>Tên</th>
                <th>Đổi Mật Khẩu / Cập Nhật / Xoá</th>
            </tr>


            <?php
            //Query to Get all Admin
            $sql = "SELECT * FROM admin";

            //Execute the Query
            $res = mysqli_query($conn, $sql);

            //Check
            if ($res == TRUE) {
                // Count Rows to Check whether we have data in database or not
                $count = mysqli_num_rows($res); // Function to get all the rows in database

                $sn = 1; //Create a Variable and Assign the Value

                //Check the num of rows
                if ($count > 0) {

                    while ($rows = mysqli_fetch_assoc($res)) {
                        $id = $rows["id"];
                        $full_name = $rows["full_name"];
                        $username = $rows["username"];

                        //Display the Values in our Table
            ?>


                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $full_name; ?></td>
                            <td><?php echo $username; ?></td>
                            <td>
                                <a href="<?php echo $siteurl; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Đổi Mật Khẩu</a>
                                <a href="<?php echo $siteurl; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Cập Nhật</a>
                                <a href="<?php echo $siteurl; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Xoá</a>
                            </td>
                        </tr>

            <?php
                    }
                } else {
                    echo "Not Data";
                }
            } else {
            }
            ?>
        </table>
    </div>


    <?php include("partials/footer.php"); ?>