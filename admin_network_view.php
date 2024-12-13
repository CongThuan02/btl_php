<!-- Phần xem danh sách mạng xã hội
Yêu cầu :In ra thông tin mạng xã hội (table network)
        :Phải có nút thêm,sửa,xóa liên kết qua id
-->
<?php
include('admin_header.php');
include('admin_sidebar.php');
?>

<div class="container">
    <div class="title">
        Xem danh sách mạng xã hội
        <a href="admin_network_add.php">Thêm mạng xã hội</a>
    </div>
    <table>
        <tr>
            <th>Số thứ tự mạng xã hội</th>
            <th>Icon mạng xã hội</th>
            <th>Liên kết mạng xã hội</th>
            <th>Xóa mạng xã hội</th>
            <th>Cập nhập mạng xã hội</th>
        </tr>
        <?php
        $i = 0;
        $sql = "SELECT * FROM `network`";
        $res = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_array($res)) {
            $id = $row['id'];
            $icon = $row['icon'];
            $link = $row['link'];
            $i++;
            echo "
                <tr>
               <td>$i</td>
               <td>
               $icon
               </td>
               <td>$link</td>
               <td>
                   <a href='admin_network_delete.php?id=$id'>Xóa</a>
               </td>
               <td>
                   <a href='admin_network_update.php?id=$id'>Chỉnh sửa</a>
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