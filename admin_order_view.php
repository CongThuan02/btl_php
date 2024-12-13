<!-- Phần xem danh sách đơn đặt hàng
Yêu cầu :In ra thông tin đơn đặt hàng của bảng order
        :Phải có nút xóa liên kết qua id
-->
<?php
include('admin_header.php');
include('admin_sidebar.php');
?>

<div class="container">
    <div class="title">
        Xem danh sách đơn đặt hàng
    </div>
    <table>
        <tr>
            <th>Số thứ tự đơn đặt hàng</th>
            <th>Email đơn đặt hàng</th>
            <th>Mã hóa đơn đặt hàng</th>
            <th>Số lượng sản phẩm </th>
            <th>Kích thước sản phẩm </th>
            <th>Ngày đặt hàng </th>
            <th>Tổng cộng </th>
            <th>Trạng thái đặt hàng </th>
            <th>Xóa đơn đặt hàng</th>
        </tr>
        <?php
        $sql = "SELECT * FROM `order`";
        $res = mysqli_query($con, $sql);
        $i = 0;
        while ($row = mysqli_fetch_array($res)) {
            $order_id = $row['order_id'];
            $user_id = $row['user_id'];
            $receipt = $row['receipt'];
            $money = $row['money'];
            $qty = $row['qty'];
            $size = $row['size'];
            $date = $row['date'];
            $status = $row['status'];
            $sum = $money * $qty;
            $i++;
            $sql_2 = "SELECT * FROM `user` where user_id='$user_id'";
            // echo $sql_2;
            $res_2 = mysqli_query($con, $sql_2);
            $row_2 = mysqli_fetch_array($res_2);
            $user_email = $row_2['user_email'];
            echo "
            <tr>
                <td>$i</td>
                <td>$user_email</td>
                <td>$receipt</td>
                <td>$qty</td>
                <td>$size </td>
                <td>$date </td>
                <td>$sum </td>
                <td>$status </td>
                <td>
                <a href='admin_order_delete.php?order_id=$order_id'>Xóa</a>
            </td>
            </tr>
            ";
        }
        ?>
    </table>
</div>

<?php
include('admin_footer.php');
?>