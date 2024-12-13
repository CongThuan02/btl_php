<!-- Phần xem danh sách người dùng
Yêu cầu :In ra thông tin người dùng bảng user
        :Phải có nút xóa liên kết qua id
-->
<?php
include('admin_header.php');
include('admin_sidebar.php');
?>

<div class="container">
    <div class="title">
        Xem danh sách người dùng
    </div>
    <table>
        <tr>
            <th>Số thứ tự người dùng</th>
            <th>Tên người dùng</th>
            <th>Email người dùng</th>
            <th>Số điện thoại người dùng</th>
            <th>Xóa người dùng</th>
        </tr>
        <?php
        $sql = "SELECT * FROM `user`";
        $res = mysqli_query($con, $sql);
        $i = 0;
        while ($row = mysqli_fetch_array($res)) {
            $user_id = $row['user_id'];
            $user_name = $row['user_name'];
            $user_email = $row['user_email'];
            $user_phone = $row['user_phone'];
            $i++;
            echo "
            <tr>
                <td>$i</td>
                <td>$user_name</td>
                <td>$user_email</td>
                <td>$user_phone</td>
                <td>
                    <a href='admin_user_delete.php?user_id=$user_id'>Xóa</a>
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