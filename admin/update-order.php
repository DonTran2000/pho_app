<?php include("partials/menu.php") ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Sửa</h1>
        <br><br>

        <?php

        // Check whether id is set or not
        if (isset($_GET["id"])) {

            $id = $_GET["id"];

            $sql = "SELECT * FROM orders WHERE id=$id";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            if ($count == 1) {

                $row = mysqli_fetch_assoc($res);

                $food = $row["food"];
                $price = $row["price"];
                $qty = $row["qty"];
                $status = $row["status"];
                $cases = $row["cases"];
                $customer_name = $row["customer_name"];
                $customer_contact = $row["customer_contact"];
                $customer_email = $row["customer_email"];
                $customer_address = $row["customer_address"];
            } else {
                header("location:" . $siteurl . "admin/manage-order.php");
            }
        } else {
            header("location:" . $siteurl . "admin/manage-order.php");
        }


        ?>

        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Tên món </td>
                    <td><b><?php echo $food; ?> </b></td>
                </tr>

                <tr>
                    <td>Giá </td>
                    <td>
                        <b><?php echo $price; ?></b>
                    </td>
                </tr>

                <tr>
                    <td>Số lượng: </td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Tình trạng </td>
                    <td>
                        <select name="status">
                            <option <?php if ($status == "Chưa xong") {
                                        echo "selected";
                                    } ?> value="Chưa xong">Chưa xong</option>
                            <option <?php if ($status == "Đã xong") {
                                        echo "selected";
                                    } ?> value="Đã xong">Đã xong</option>
                            <option <?php if ($status == "Đã huỷ") {
                                        echo "selected";
                                    } ?> value="Đã huỷ">Đã huỷ</option>
                        </select>
                    </td>
                </tr>



                <tr>
                    <td>Cases</td>
                    <td>
                        <input <?php if ($cases == "Tại Chỗ") {
                                    echo "checked";
                                } ?> type="radio" name="cases" value="Tại Chỗ">Tại chỗ <br><br>
                        <input <?php if ($cases == "Mang Về") {
                                    echo "checked";
                                } ?> type="radio" name="cases" value="Mang Về">Mang Về
                    </td>
                </tr>

                <tr>
                    <td>Tên: </td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <input type="submit" name="submit" value="Sửa" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php
        if (isset($_POST["submit"])) {
            // echo "clicked";

            $id = $_POST["id"];
            $price = $_POST["price"];
            $qty = $_POST["qty"];
            $total = $price * $qty;
            $status = $_POST["status"];
            $cases = $_POST["cases"];

            $customer_name = $_POST["customer_name"];
            // $customer_contact = $_POST["customer_contact"];
            // $customer_email = $_POST["customer_email"];
            // $customer_address = $_POST["customer_address"];

            $sql2 = "UPDATE orders SET 
                    qty = $qty,
                    total = $total,
                    status = '$status',
                    cases = '$cases',
                    customer_name = '$customer_name'
                    WHERE id=$id
                ";

            // echo $sql2;die(); 

            $res2 = mysqli_query($conn, $sql2);

            if ($res2 == TRUE) {
                $_SESSION["update"] = "<div class='success'>Đã sửa thành công.</div>";
                header("location:" . $siteurl . "admin/manage-order.php");
            } else {
                $_SESSION["update"] = "<div class='error'>Sửa thất bại.</div>";
                header("location:" . $siteurl . "admin/manage-order.php");
            }
        }
        ?>

    </div>
</div>


<?php include("partials/footer.php") ?>