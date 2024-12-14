<?php
$active = 'Account';
include('header.php');

// Kiểm tra nếu người dùng chưa đăng nhập
if (!isset($_SESSION['user_email'])) {
    echo "<script>window.open('checkout.php', '_self')</script>";
}

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
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
                    Thông tin liên hệ
                </div>

                <form action="user_order-pay.php?update_id=<?php echo $order_id; ?>" method="post" class="user__form" onsubmit="return validateForm()">
                    <label>
                        Họ và tên (*)
                    </label>
                    <input type="text" name="receipt" id="receipt" placeholder="Họ và tên"  
                           oninvalid="this.setCustomValidity('Vui lòng nhập họ và tên')" 
                           oninput="this.setCustomValidity('')">
                    <div id="error_receipt" style="color: red;"></div> <!-- Lỗi hiển thị -->

                    <label>
                        Số điện thoại (*)
                    </label>
                    <input type="text" name="money" id="money" placeholder="Số điện thoại" maxlength="10" 
                           pattern="\d{10}" title="Số điện thoại phải có 10 chữ số"  
                           oninvalid="this.setCustomValidity('Vui lòng nhập số điện thoại hợp lệ')" 
                           oninput="this.setCustomValidity('')">
                    <div id="error_money" style="color: red;"></div> <!-- Lỗi hiển thị -->

                    <label>
                        Email (*)
                    </label>
                    <input type="email" name="code" id="code" placeholder="Email"  
                           oninvalid="this.setCustomValidity('Vui lòng nhập địa chỉ email hợp lệ')" 
                           oninput="this.setCustomValidity('')">
                    <div id="error_code" style="color: red;"></div> <!-- Lỗi hiển thị -->

                    <label>
                        Ngày giao dịch
                    </label>
                    <input type="date" name="date" id="date" placeholder="Nhập ngày giao dịch" 
                           oninvalid="this.setCustomValidity('Vui lòng nhập ngày giao dịch')" 
                           oninput="this.setCustomValidity('')">
                    <div id="error_date" style="color: red;"></div> <!-- Lỗi hiển thị -->

                    <button class="button" name="submit" type="submit">Xác liên hệ</button>
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

    // Kiểm tra xem các thông tin bắt buộc có hợp lệ không
    if (empty($receipt) || empty($money) || empty($code) || empty($date)) {
        
    } else {
        // Câu lệnh SQL để insert thông tin thanh toán vào bảng "pay"
        $sql = "INSERT INTO pay (receipt, money, code, date) VALUES ('$receipt', '$money', '$code','$date')";
        $res = mysqli_query($con, $sql);  // Thực thi câu lệnh SQL

        // Kiểm tra xem câu lệnh có thành công không
        if (!$res) {
            echo "Error inserting data into pay: " . mysqli_error($con);
        } else {
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
}
?>

<script>
// Validate Form JavaScript
function validateForm() {
    let isValid = true;
    
    // Lấy giá trị input
    let receipt = document.getElementById("receipt").value;
    let money = document.getElementById("money").value;
    let code = document.getElementById("code").value;
    let date = document.getElementById("date").value;

    // Kiểm tra thông tin Họ và tên
    if (receipt == "") {
        document.getElementById("error_receipt").innerHTML = "Vui lòng nhập họ và tên.";
        isValid = false;
    } else {
        document.getElementById("error_receipt").innerHTML = "";
    }

    // Kiểm tra số điện thoại
    if (money == "" || !/^\d{10}$/.test(money)) {
        document.getElementById("error_money").innerHTML = "Số điện thoại phải có 10 chữ số.";
        isValid = false;
    } else {
        document.getElementById("error_money").innerHTML = "";
    }

    // Kiểm tra email
    if (code == "") {
        document.getElementById("error_code").innerHTML = "Vui lòng nhập địa chỉ email.";
        isValid = false;
    } else {
        document.getElementById("error_code").innerHTML = "";
    }

    // Kiểm tra ngày giao dịch
    if (date == "") {
        document.getElementById("error_date").innerHTML = "Vui lòng nhập ngày giao dịch.";
        isValid = false;
    } else {
        document.getElementById("error_date").innerHTML = "";
    }

    return isValid;
}
</script>