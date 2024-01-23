<?php include("partials/menu.php") ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Quán Lý Đơn Hàng</h1>
        <br><br>

        <?php
        if ($_SESSION["update"]) {
            echo $_SESSION["update"];
            unset($_SESSION["update"]);
        }

        if ($_SESSION["new"]) {
            echo $_SESSION["new"];
            unset($_SESSION["new"]);
        }
        ?>

        <br><br>

        <form action="delete-order.php" method="post">

            <table class="tbl-full">
                <tr>
                    <th class="text-center"><button type="submit" name="orders_delete_multiple_btn" class="btn-danger">Xoá</button></th>
                    <th class="text-center">Số</th>
                    <th class="text-center">Món</th>
                    <th class="text-center">Giá</th>
                    <th class="text-center">Số lượng</th>
                    <th class="text-center">Tổng</th>
                    <th class="text-center">Ngày</th>
                    <th class="text-center">Tình Trạng</th>
                    <th class="text-center">Trường Hợp</th>
                    <th class="text-center">Tên</th>
                    <!-- <th class="text-center">Contact</th>
                <th class="text-center">Email</th>
                <th class="text-center">Address</th> -->
                    <th class="text-center">Cập Nhật</th>
                </tr>

                <?php
                // Get all the orders from DB
                $sql = "SELECT * FROM orders";

                date_default_timezone_set("Asia/ho_chi_minh");

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                $sn = 1; // Create a Serial Number and set its initail value as 1

                if ($count > 0) {

                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row["id"];
                        $food = $row["food"];
                        $price = $row["price"];
                        $qty = $row["qty"];
                        $total = $row["total"];
                        $order_date = $row["order_date"];
                        $status = $row["status"];
                        $cases = $row["cases"];
                        $customer_name = $row["customer_name"];
                        // $customer_contact = $row["customer_contact"];
                        // $customer_email = $row["customer_email"];
                        // $customer_address = $row["customer_address"];

                ?>
                        <tr>
                            <td class="text-center" style="width: 10px;"><input type="checkbox" name="orders_delete_id[]" value="<?= $id ?>"></td>
                            <td class="text-center"><?php echo $sn++; ?></td>
                            <td class="text-center"><?php echo $food; ?></td>
                            <td class="text-center"><?php echo $price; ?></td>
                            <td class="text-center"><?php echo $qty; ?></td>
                            <td class="text-center"><?php echo $total ?></td>
                            <td class="text-center"><?php echo $order_date; ?></td>

                            <td class="text-center">
                                <?php
                                //Đã đặt hàng, Đã xong , Đã huỷ

                                if ($status == "Chưa xong") {
                                    echo "<label>Chưa xong</label>";
                                } elseif ($status == "Đã xong") {
                                    echo "<label style='color: green;'>$status</label>";
                                } elseif ($status == "Đã huỷ") {
                                    echo "<label style='color: red;'>$status</label>";
                                }
                                ?>
                            </td>

                            <td class="text-center"><?php echo $cases; ?></td>
                            <td class="text-center"><?php echo $customer_name; ?></td>

                            <td class="text-center">
                                <a href="<?php echo $siteurl; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Sửa</a>
                            </td>
                        </tr>
                <?php

                    }
                } else {
                    echo "<tr><td colspan='11' class='error'>Không có đơn hàng.</td></tr>";
                    $sql2 = "ALTER TABLE orders auto_increment = 1";

                    $res2 = mysqli_query($conn, $sql2);
                }
                ?>
            </table>
        </form>
    </div>
</div>

<?php include("partials/footer.php") ?>