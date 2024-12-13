<!-- Phần xem danh sách sản phẩm 
Yêu cầu :In ra thông tin sản phẩm (table slider)
        :Phải có nút thêm,sửa,xóa liên kết qua id
-->
<?php
include('admin_header.php');
include('admin_sidebar.php');
?>

<div class="container">
    <div class="title">
        Xem danh trình chiếu
        <a href="admin_silder_add.php">Thêm sản phẩm</a>
    </div>
    <table>
        <tr>
            <th>Số thứ tự trình chiếu</th>
            <th>Ảnh trình chiếu</th>
            <th>Xóa trình chiếu</th>
            <th>Cập nhập trình chiếu</th>
        </tr>
        <?php
        $sql = "SELECT * FROM `slider`";
        $res = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_array($res)) {
            $slider_id = $row['slider_id'];
            $slider_image = $row['slider_image'];
            echo "
            <tr>
                <td>$slider_id</td>
                <td>
                    <img src='./image/$slider_image' alt='' />
                </td>
                <td>
                    <a href='admin_slider_delete.php?slider_id=$slider_id'>Xóa</a>
                </td>
                <td>
                    <a href='admin_slider_update.php?slider_id=$slider_id'>Chỉnh sửa</a>
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