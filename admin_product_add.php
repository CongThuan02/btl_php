<!-- Phần thêm sản phẩm 
Yêu cầu:khi ấn vào nút thêm sản phẩm thì dữ liệu sẽ được thêm vào bảng product
       :sau khi ấn thêm sẽ chuyển về trang xem

 -->
<?php
include('admin_header.php');
include('admin_sidebar.php');
?>

<div class="container">
    <div class="title">Thêm Sản Phẩm</div>
    <form action="admin_product_add.php" method="post" enctype="multipart/form-data">
        <div class="form__group">
            <span>Tiêu đề sản phẩm</span>
            <input name="product_title" type="text" required />
        </div>
        <div class="form__group">
            <span>Loại</span>
            <select name="product_cat">
                <option selected disabled>Chọn Loại</option>
                <!-- Chọn danh mục muốn thêm vào -->
                <?php
                $sql = "SELECT * FROM `product_categories`";
                $res = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_array($res)) {
                    $p_cat_id = $row['p_cat_id'];
                    $p_cat_title = $row['p_cat_title'];
                    echo "
                    <option value='$p_cat_id'> $p_cat_title </option>     
                        ";
                }
                ?>
            </select>
        </div>
        <div class="form__group">
            <span>Danh mục sản phẩm</span>
            <select name="cat">
                <!-- Chọn sản phẩm thuộc loại -->
                <option selected disabled>Chọn Danh Mục</option>
                <?php
                $sql = "SELECT * FROM `categories`";
                $res = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_array($res)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    echo "
                        <option value='$cat_id'> $cat_title </option>
                        ";
                }
                ?>
            </select>
        </div>
        <div class="form__group">
            <span>Ảnh</span>
            <input name="product_img" type="file" />
        </div>
        <div class="form__group">
            <span>Giá sản phẩm</span>
            <input name="product_price" type="text" required />
        </div>
        <div class="form__group">
            <span>Từ khóa sản phẩm</span>
            <input name="product_keywords" type="text" required />
        </div>
        <div class="form__group" style=" align-items:start;">
            <span>Mô Tả sản phẩm</span>
            <textarea name="product_desc" type="text" required> </textarea>
        </div>
        <div class="form__group">
            <span></span>
            <input type="submit" value="gửi" name="submit">
        </div>
    </form>
</div>

<?php
include('admin_footer.php');
?>
<?php
// gửi tiêu đề ,tên danh muc,tên loại,giá ,từ khóa để tìm kiếm,ảnh ,mô tả lên sql;
if (isset($_POST['submit'])) {
    $product_title = $_POST['product_title'];
    // echo $product_title;
    $product_cat = $_POST['product_cat'];
    // echo  $product_cat;
    $cat = $_POST['cat'];
    // echo $cat;
    $product_price = $_POST['product_price'];
    // echo $product_price;
    $product_keywords = $_POST['product_keywords'];
    // echo $product_keywords;
    $product_desc = $_POST['product_desc'];
    // echo $product_desc;
    $product_img = $_FILES['product_img']['name'];
    // echo $product_img;
    $temp_name = $_FILES['product_img']['tmp_name'];
    move_uploaded_file($temp_name, "image/$product_img");
    $sql = "insert into product (p_cat_id,cat_id,date,product_title,product_img,product_price,product_keywords,product_desc) 
    values ('$product_cat','$cat',NOW(),'$product_title','$product_img','$product_price','$product_keywords','$product_desc')";
    $res = mysqli_query($con, $sql);
    if ($res) {
        echo "<script>alert('Sản phẩm được thêm thành công ')</script>";
        echo "<script>window.open('admin_product_view.php','_self')</script>";
    }
}
?>