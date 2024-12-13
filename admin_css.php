<!-- Chỉnh sửa CSS 
Yêu cầu :Lấy dữ liệu css từ file ./css/style.css
        :Khi ấn nút cập nhật thì file css mới được thêm vào file css cũ
-->
<?php
include('admin_header.php');
include('admin_sidebar.php');
?>
<?php

$file = "./css/style.css";

if (file_exists($file)) {
    $data = file_get_contents($file);
}

?>

<div class="container">
    <form method="post">
        <textarea style="width:100%;height:100vh; overflow-y: scroll;" name=" newdata">
    <?php echo $data; ?>
    </textarea>
        <input type="submit" style="padding:20px;width:100%;" name="submit" value="Update CSS">
    </form>
</div>

<?php
include('admin_footer.php');
?>
<?php

if (isset($_POST['submit'])) {
    // css mới
    $newdata = $_POST['newdata'];
    // mở file style.css cũ
    $handle = fopen($file, "w");
    //ghi sang file mới
    fwrite($handle, $newdata);
    // đóng file
    fclose($handle);
    echo "<script>alert('Bạn đã chỉnh sửa css')</script>";
    echo "<script>window.open('admin_css.php','_self')</script>";
}

?>