<!-- Phần sửa sản phẩm 
Yêu cầu :Khi ấn vào nút cập nhật sản phẩm  thì sẽ cập nhật lại bảng categories
        :sau khi ấn cập nhật sẽ chuyển về trang xem
Người làm :Ngô Thị Ánh Tuyết
Fixbug,testing:Lê Minh Phương
 --><?php
        include('admin_header.php');
        include('admin_sidebar.php');
        ?>

<form class="container" action="admin_product_update.php" method="post" enctype="multipart/form-data">
    <div class="title">
        Chỉnh sửa sản phẩm
    </div>
    <table>
        <tr>
            <th>Tiêu đề sản phẩm </th>
            <th>Giá sản phẩm </th>
            <th>Mô tả sản phẩm </th>
            <th>Từ khóa sản phẩm </th>
            <th>Ảnh sản phẩm </th>
            <th>Ảnh sản phẩm </th>
            <th>Cập nhật sản phẩm </th>
        </tr>
        <?php
                if (isset($_GET['product_id'])) {
                        $product_id = $_GET['product_id'];
                        $sql = "SELECT * from `product` where product_id='$product_id'";
                        $res = mysqli_query($con, $sql);
                        $row = mysqli_fetch_array($res);
                        $product_title = $row['product_title'];
                        $product_desc = $row['product_desc'];
                        $product_price = $row['product_price'];
                        $product_img = $row['product_img'];
                        $product_keywords = $row['product_keywords'];
                        echo "
                   <tr>
                       <td><input type='text' name='product_title' value='$product_title'></td>
                       <td><input type='text' name='product_desc' value='$product_desc'></td>
                       <td><input type='text' name='product_price' value='$product_price'></td>
                       <td><input type='text' name='product_keywords' value='$product_keywords'></td>
                       <td><img src='./image/$product_img'></td>
                       <td><input type='file'  name='product_img' value='$product_img'/></td>
                       <input type='hidden' name='product_id' value='$product_id'>                  
                       <td><input type='submit' name='submit' value='Gửi'></td>    
                   </tr>
                   ";
                }
                ?>
    </table>
    </from>
    <?php
        include('admin_footer.php');
        ?>
    <?php
        if (isset($_POST['submit'])) {
                $product_id = $_POST['product_id'];
                $product_title = $_POST['product_title'];
                $product_desc = $_POST['product_desc'];
                $product_price = $_POST['product_price'];
                $product_keywords = $_POST['product_keywords'];
                $product_img = $_FILES['product_img']['name'];
                $temp_name = $_FILES['product_img']['tmp_name'];
                move_uploaded_file($temp_name, "./image/$product_img");
                $sql = "UPDATE `product` SET 
                product_img='$product_img',
                product_title='$product_title',
                product_desc='$product_desc',
                product_price='$product_price',
                product_keywords='$product_keywords'
                where product_id='$product_id'";
                $res = mysqli_query($con, $sql);
                // echo $sql;
                if ($res) {
                        echo "<script>alert('Đổi sản phẩm thành công')</script>";
                        echo "<script>window.open('admin_product_view.php','_self')</script>";
                }
        }

        ?>