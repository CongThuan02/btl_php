<!-- Phần xem danh sách thể loại
Yêu cầu :In ra thông tin thể loại (bảng product_categories)
        :Phải có nút thêm,sửa,xóa liên kết qua id
Người làm :Ngô Thị Ánh Tuyết
Fixbug,testing:Lê Minh Phương
-->
<?php
include('admin_header.php');
include('admin_sidebar.php');
?>

<div class="container">
    <div class="title">
        Xem danh sách thể loại
        <a href="admin_product_cate_add.php">Thêm thể loại</a>
    </div>
    <table>
        <tr>
            <th>Số thứ tự thể loại</th>
            <th>Tiêu đề thể loại</th>
            <th>Mô tả thể loại</th>
            <th>Xóa thể loại</th>
            <th>Cập nhập thể loại</th>
        </tr>
        <?php
        $sql = "SELECT * FROM `product_categories`";
        $res = mysqli_query($con, $sql);
        $i = 0;
        while ($row = mysqli_fetch_array($res)) {
            $p_cat_id = $row['p_cat_id'];
            $p_cat_title = $row['p_cat_title'];
            $p_cat_desc = $row['p_cat_desc'];
            $i++;
            echo "
            
            <tr>
                <td>$i</td>
                <td>$p_cat_title</td>
                <td>
                    $p_cat_desc
                </td>
                <td>
                    <a href='admin_product_cate_delete.php?p_cat_id=$p_cat_id'>Xóa</a>
                </td>
                <td>
                    <a href='admin_product_cate_update.php?p_cat_id=$p_cat_id'>Chỉnh sửa</a>
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