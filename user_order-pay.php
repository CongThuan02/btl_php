<?php
$active = 'Account';
include('header.php');

// Kiểm tra nếu người dùng chưa đăng nhập
if (!isset($_SESSION['user_email'])) {
    echo "<script>window.open('checkout.php', '_self')</script>";
}
?>

<div class="main">
    <div class="shop">
        <div class="shop__container">
            <ul class="shop__breadcroumb">
                <li><a href="index.php">Trang Chủ</a></li>
                <li>Tài khoản</li>
            </ul>
            <?php
            include('user_sidebar.php');
            ?>
            <div class="user__content">
                <div class="user__title">
                    Xác nhận thanh toán
                </div>
                <?php
                if (isset($_GET['order_id'])) {
                    $order_id = $_GET['order_id'];
                }
                ?>
                <form action="user_order-pay.php?update_id=<?php echo $order_id; ?>" method="post" class="user__form">
                    <label>
                        Họ và tên (*)
                    </label>
                    <input type="text" required name="receipt" placeholder="Họ và tên">
                    
                    <label>
                        Số điện thoại (*)
                    </label>
                    <input type="text" required name="money" placeholder="Số điện thoại" maxlength="10" pattern="\d{10}" title="Số điện thoại phải có 10 chữ số">
                   
                    <label>
                        Email (*)
                    </label>
                    <input type="email" required name="code" placeholder="Email">
                    <label>
                        Ngày giao dịch
                    </label>
                    <input type="date" required name="date" placeholder="Nhập ngày giao dịch">
                    <button class="button" name="submit" type="submit">Xác nhận thanh toán</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include('footer.php');

// Kiểm tra nếu người dùng đã gửi form
if (isset($_POST['submit'])) {
    $update_id = $_GET['update_id'];  // Lấy ID của đơn hàng
    $receipt = $_POST['receipt'];     // Lấy thông tin người nhận
    $money = $_POST['money'];         // Lấy số điện thoại
    $code = $_POST['code'];           // Lấy email
    $date = $_POST['date'];
    // Câu lệnh SQL để insert thông tin thanh toán vào bảng "pay"
    $sql = "INSERT INTO pay (receipt, money, code,date) VALUES ('$receipt', '$money', '$code','$date')";
    $res = mysqli_query($con, $sql);  // Thực thi câu lệnh SQL

    // Kiểm tra xem câu lệnh có thành công không
    if (!$res) {
        // Nếu có lỗi, hiển thị lỗi
        echo "Error inserting data into pay: " . mysqli_error($con);
    } else {
        // Nếu câu lệnh thành công
        echo "Record inserted successfully into pay.";
    }

    // Cập nhật trạng thái đơn hàng
    $complete = "Chờ nhận hàng";
    $sql_2 = "UPDATE `order` SET status='$complete' WHERE order_id='$update_id'";
    $res_2 = mysqli_query($con, $sql_2);

    // Cập nhật trạng thái trong bảng "pending"
    $sql_3 = "UPDATE pending SET status='$complete' WHERE order_id='$update_id'";
    $res_3 = mysqli_query($con, $sql_3);

    // Kiểm tra nếu cập nhật trạng thái đơn hàng và pending thành công
    if ($res_3) {
        echo "<script>alert('Cảm ơn bạn đã thanh toán, chúng tôi sẽ xác nhận và gửi đến bạn trong 48h');</script>";
        echo "<script>window.open('user_orders.php', '_self');</script>";
    }
}
?>