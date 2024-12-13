<!-- Phần xem danh sách khối
Yêu cầu :In ra thông tin khối (table box)
        :Phải có nút thêm,sửa,xóa liên kết qua id
-->
<?php
include('admin_header.php');
include('admin_sidebar.php');
?>

<div class="container">
    <div class="title">
        Xem danh sách khối
        <a href="admin_box_add.php">Thêm khối</a>
    </div>
    <table>
        <tr>
            <th>Số thứ tự khối</th>
            <th>Tiêu đề khối</th>
            <th>Icon khối</th>
            <th>Xóa khối</th>
            <th>Cập nhập khối</th>
        </tr>
        <?php
        $i = 0;
        $sql = "SELECT * FROM `box`";
        $res = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_array($res)) {
            $id = $row['id'];
            $title = $row['title'];
            $icon = $row['icon'];
            $i++;
            echo "
                <tr>
               <td>$i</td>
               <td>$title</td>
               <td>
                   $icon
               </td>
               <td>
                   <a href='admin_box_delete.php?id=$id'>Xóa</a>
               </td>
               <td>
                   <a href='admin_box_update.php?id=$id'>Chỉnh sửa</a>
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