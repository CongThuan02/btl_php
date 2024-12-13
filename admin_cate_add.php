<!-- Phần thêm danh mục sản phẩm 
Yêu cầu:khi ấn vào nút danh mục sản phẩm  thì dữ liệu sẽ được thêm vào bảng categories
       :sau khi ấn thêm sẽ chuyển về trang xem
-->
<?php
include('admin_header.php');
include('admin_sidebar.php');
?>

<div class="container">
    <div class="title">Thêm danh mục sản phẩm</div>
    <form action="admin_cate_add.php" method="post">
        <div class="form__group">
            <span>Tiêu đề danh mục sản phẩm</span>
            <input name="cat_title" type="text" required />
        </div>
        <div class="form__group">
            <span>Mô tả danh mục sản phẩm</span>
            <input name="cat_desc" type="text" required />
        </div>
        <div class="form__group">
            <span></span>
            <input type="submit" value="Gửi" name="submit">
        </div>
    </form>
</div>

<?php
include('admin_footer.php');
?>
<?php
if (isset($_POST['submit'])) {
    $cat_title = $_POST['cat_title'];
    // echo $cat_title;
    $cat_desc = $_POST['cat_desc'];
    // echo  $cat_desc;
    $sql = "INSERT INTO `categories` (cat_title,cat_desc) 
       VALUES ('$cat_title','$cat_desc')";
    $res = mysqli_query($con, $sql);
    if ($res) {
        echo "<script>alert('Danh mục sản phẩm được thêm thành công ')</script>";
        echo "<script>window.open('admin_cate_view.php','_self')</script>";
    }
}
?>