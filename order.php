<?php include("partials-font/menu.php"); ?>

<?php

// Check whether food id is set or not
if (isset($_GET["food_id"])) {
    // Get the food id and details of the selected food
    $food_id = $_GET["food_id"];

    // Get the Details of the Selected Food
    $sql = "SELECT * FROM food WHERE id=$food_id";

    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);

    if ($count == 1) {

        $row = mysqli_fetch_assoc($res);

        $title = $row["title"];
        $price = $row["price"];
        $image_name = $row["image_name"];
    } else {
        // Food not available.
        header("location:" . $siteurl);
    }
} else {
    // Redirect to Homepage
    header("location:" . $siteurl);
}



?>

<!-- fOOD sEARCH Section Starts Here -->

<section class="food-search">
    <div class="container">

        <h2 class="text-center text-white">Điền vào mẫu này để xác nhận đơn hàng.</h2>

        <form action="order.php" method="POST" class="order">
            <fieldset>
                <legend>Món đã chọn</legend>

                <div class="food-menu-img">
                    <?php

                    if ($image_name == "") {
                        echo "<div class='error'>Image not Available.</div>";
                    } else {
                    ?>
                        <img src="<?php echo $siteurl; ?>images/food/<?php echo $image_name; ?>" class="img-responsive img-curve">
                    <?php
                    }

                    ?>

                </div>

                <div class="food-menu-desc">
                    <h3><?php echo $title; ?></h3>
                    <input type="hidden" name="food" value="<?php echo $title; ?>">

                    <p class="food-price"><?php echo $price; ?></p>
                    <input type="hidden" name="price2" value="<?php echo $price; ?>">



                    <div class="order-label">Số lượng</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>
                    <table class="tbl-30">
                        <tr>
                            <!-- <td>Case:</td> -->
                            <td>
                                <input type="radio" name="cases" value="Tại Chỗ">Tại chỗ <br><br>
                                <input type="radio" name="cases" value="Mang Về">Mang Về
                            </td>
                        </tr>
                    </table>


                </div>

            </fieldset>

            <fieldset>
                <legend>Chi tiết khách hàng</legend>
                <div class="order-label">Bàn / Tên</div>
                <input type="text" name="full-name" placeholder="Bàn số ?" class="input-responsive" required>
<!-- 
                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea> -->

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary" required>
            </fieldset>

        </form>
    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php include("partials-font/footer.php"); ?>

<?php

// Check whether submit button is clicked or not
if (isset($_POST["submit"])) {

    // Get all the details from the form
    $food = $_POST["food"];
    $price2 = $_POST["price2"];
    $qty = $_POST["qty"];

    $total = $price2 * $qty;

    date_default_timezone_set("Asia/ho_chi_minh");

    $order_date = date('Y-m-d H:i:s');

    $status = "Chưa xong";    // Ordered, On Delivery, Delivered, Cancelled

    $cases = $_POST["cases"];

    $customer_name = $_POST["full-name"];
    
    // $customer_contact = $_POST["contact"];
    // $customer_email = $_POST["email"];
    // $customer_address = $_POST["address"];

    $sql2 = "INSERT INTO orders (food, price, qty, total, order_date, status, cases, customer_name) 
                    VALUES ('$food', $price2, $qty, $total, '$order_date', '$status', '$cases', '$customer_name')";

    $res2 = mysqli_query($conn, $sql2);

    if ($res2 == TRUE) {
        $_SESSION["order"] = "<div class='success text-center'>Order Food Ordered Successfully.</div>";
        header("location:" . $siteurl);
    } else {
        $_SESSION["order"] = "<div class='error text-center'>Failed to order food.</div>";
        header("location:" . $siteurl);
    }
}
?>