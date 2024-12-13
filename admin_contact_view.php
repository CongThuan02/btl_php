<!-- Phần xem danh sách phản hồi
Yêu cầu :In ra thông tin liên hệ bảng contact
        :Phải có nút xóa liên kết qua id
-->
<?php
include('admin_header.php');
include('admin_sidebar.php');
?>

<div class="container">
    <div class="title">
        Xem danh sách phản hồi
    </div>
    <table>
        <tr>
            <th>Số thứ tự phản hồi</th>
            <th>Tên người phản hồi phản hồi</th>
            <th>Email phản hồi phản hồi</th>
            <th>Tiêu đề phản hồi</th>
            <th>Tin nhắn phản hồi</th>
            <th>Xóa phản hồi</th>
        </tr>
        <?php
        $sql = "SELECT * FROM `contact`";
        $res = mysqli_query($con, $sql);
        $i = 0;
        while ($row = mysqli_fetch_array($res)) {
            $id = $row['id'];
            $name = $row['name'];
            $email = $row['email'];
            $subject = $row['subject'];
            $message = $row['message'];
            $i++;
            echo "
            <tr>
                <td>$i</td>
                <td>$name</td>
                <td>$email</td>
                <td>$subject</td>
                <td>$message</td>
                <td>
                    <a href='admin_contact_delete.php?id=$id'>Xóa</a>
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