<?php
include("db.php");
include("functions.php");
?>
<?php
// Lấy id người dùng
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
}
// Lấy địa chỉ ip
$ip_add = getRealIpUser();
// Gán giá trị ban đầu là chưa trả 
$status = "pending";
// Tạo giá trị ngẫu nhiên
$receipt = mt_rand();
//sql,sql_2 truy vấn các giá trị trong bảng 
$sql = "SELECT * from cart where ip_add='$ip_add'";
//$res,res_2,res_3,res_4 thực hiện truy vấn đối với cơ sở dữ liệu.
$res = mysqli_query($con, $sql);
//$row,row_2,row_3,row_4 chạy vòng lặp thực hiện nạp mảng
while ($row = mysqli_fetch_array($res)) {
    // gán cho biến bằng với cột p_id
    $product_id = $row['p_id'];
    // gán cho biến bằng với cột qty
    $product_qty = $row['qty'];
    // gán cho biến bằng với cột size
    $product_size = $row['size'];
    $sql_2 = "select * from product where product_id='$product_id'";
    $res_2 = mysqli_query($con, $sql_2);
    while ($row_2 = mysqli_fetch_array($res_2)) {
        $sub_total = $row_2['product_price'] * $product_qty;
        // thêm giá trị vừa nhận vào bảng order,pending
        $sql_3 = "INSERT INTO `order` (user_id,money,receipt,qty,size,date,status) 
        VALUES ('$user_id','$sub_total','$receipt','$product_qty','$product_size',NOW(),'$status')";
        // echo $sql_3;
        $res_3 = mysqli_query($con, $sql_3);
        $sql_4 = "INSERT INTO pending (user_id,receipt,product_id,qty,size,status) 
        VALUES ('$user_id','$receipt','$product_id','$product_qty','$product_size','$status')";
        $res_4 = mysqli_query($con, $sql_4);
        // xóa hàng vừa chuyển vào thanh toán
        $sql_5 = "DELETE from cart where ip_add='$ip_add'";
        $res_5 = mysqli_query($con, $sql_5);
        echo "<script>alert('Đơn đạt hàng của bạn đã được gửi.')</script>";
        echo "<script>window.open('user_orders.php','_self')</script>";
    }
}

?>