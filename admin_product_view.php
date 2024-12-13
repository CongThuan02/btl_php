<!-- Phần xem danh sách sản phẩm 
Yêu cầu :In ra thông tin sản phẩm (table product)
        :Phải có nút thêm,sửa,xóa liên kết qua id
-->
<?php
include('admin_header.php');
include('admin_sidebar.php');
?>

<div class="container">
    <div class="title">
        Xem danh sách sản phẩm
        <a href="admin_product_add.php">Thêm sản phẩm</a>
    </div>
    <table>
        <tr>
            <th>Số thứ tự sản phẩm</th>
            <th>Tiêu đề sản phẩm</th>
            <th>Hình ảnh sản phẩm</th>
            <th>Giá sản phẩm</th>
            <th>Từ khóa sản phẩm</th>
            <th>Ngày thêm sản phẩm</th>
            <th>Xóa sản phẩm</th>
            <th>Cập nhập sản phẩm</th>
        </tr>
        <?php

        $sql = "SELECT * FROM `product`";
        $res = mysqli_query($con, $sql);
        $i = 0;
        while ($row = mysqli_fetch_array($res)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_img = $row['product_img'];
            $product_price = $row['product_price'];
            $product_keywords = $row['product_keywords'];
            $date = $row['date'];
            $i++;
            echo "
            <tr>
                <td>$i</td>
                <td>$product_title</td>
                <td>
                    <img src='./image/$product_img' alt='' />
                </td>
                <td>$product_price VND</td>
                <td>$product_keywords</td>
                <td>$date</td>
                <td>
                    <a href='admin_product_delete.php?product_id=$product_id'>Xóa</a>
                </td>
                <td>
                    <a href='admin_product_update.php?product_id=$product_id'>Chỉnh sửa</a>
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