<!-- Phần xem danh sách danh mục sản phẩm 
Yêu cầu :In ra thông tin danh mục sản phẩm (table categories)
        :Phải có nút thêm,sửa,xóa liên kết qua id
-->
<?php
include('admin_header.php');
include('admin_sidebar.php');
?>

<div class="container">
    <div class="title">
        Xem danh sách danh mục sản phẩm
        <a href="admin_cate_add.php">Thêm danh mục sản phẩm</a>
    </div>
    <table>
        <tr>
            <th>Số thứ tự danh mục sản phẩm</th>
            <th>Tiêu đề danh mục sản phẩm</th>
            <th>Mô tả danh mục sản phẩm</th>
            <th>Xóa danh mục sản phẩm</th>
            <th>Cập nhập danh mục sản phẩm</th>
        </tr>
        <?php
        $i = 0;
        $sql = "SELECT * FROM `categories`";
        $res = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_array($res)) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            $cat_desc = $row['cat_desc'];
            $i++;
            echo "
                <tr>
               <td>$i</td>
               <td>$cat_title</td>
               <td>
                   $cat_desc
               </td>
               <td>
                   <a href='admin_cate_delete.php?cat_id=$cat_id'>Xóa</a>
               </td>
               <td>
                   <a href='admin_cate_update.php?cat_id=$cat_id'>Chỉnh sửa</a>
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