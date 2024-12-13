<!-- Phần xem danh sách thanh toán
Yêu cầu :In ra thông tin thanh toán bảng pay
        :Phải có nút xóa liên kết qua id
-->
<?php
include('admin_header.php');
include('admin_sidebar.php');
?>

<div class="container">
    <div class="title">
        Xem danh sách thanh toán
    </div>
    <table>
        <tr>
            <th>Số thứ tự thanh toán</th>
            <th>Mã hóa đơn thanh toán</th>
            <th>Số tiền đã thanh toán</th>
            <th>Phương thức thanh toán</th>
            <th>Mã thanh toán</th>
            <th>Ngày thanh toán</th>
            <th>Xóa thanh toán</th>
        </tr>
        <?php
        $sql = "SELECT * FROM `pay`";
        $res = mysqli_query($con, $sql);
        $i = 0;
        while ($row = mysqli_fetch_array($res)) {
            $pay_id = $row['pay_id'];
            $receipt = $row['receipt'];
            $money = $row['money'];
            $mode = $row['mode'];
            $code = $row['code'];
            $date = $row['date'];
            $i++;
            echo "
            <tr>
                <td>$i</td>
                <td>$receipt</td>
                <td>$money</td>
                <td>$mode</td>
                <td>$code</td>
                <td>$date</td>
                <td>
                    <a href='admin_pay_delete.php?pay_id=$pay_id'>Xóa</a>
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