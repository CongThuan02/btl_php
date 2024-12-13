<!-- Phần thêm thể loại 
Yêu cầu:khi ấn vào nút thêm thể loại thì dữ liệu sẽ được thêm vào bảng product_categories
       :sau khi ấn thêm sẽ chuyển về trang xem
 --><?php
    include('admin_header.php');
    include('admin_sidebar.php');
    ?>

<div class="container">
    <div class="title">Thêm Admin</div>
    <form action="admin_product_cate_add.php" method="post" enctype="multipart/form-data">
        <div class="form__group">
            <span>Tiêu đề thể loại</span>
            <input name="p_cat_title" type="text" required />
        </div>
        <div class="form__group">
            <span>Mô tả thể loại</span>
            <input name="p_cat_desc" type="text" required />
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
    $p_cat_title = $_POST['p_cat_title'];
    // echo $p_cat_title;
    $p_cat_desc = $_POST['p_cat_desc'];
    // echo  $p_cat_desc;
    $sql = "INSERT INTO `product_categories` (p_cat_title,p_cat_desc) 
       VALUES ('$p_cat_title','$p_cat_desc')";
    $res = mysqli_query($con, $sql);
    if ($res) {
        echo "<script>alert('Thể loại được thêm thành công ')</script>";
        echo "<script>window.open('admin_product_cate_view.php','_self')</script>";
    }
}
?>