<!-- Phần thêm trình chiếu 
Yêu cầu:khi ấn vào nút thêm trình chiếu thì dữ liệu sẽ được thêm vào bảng slider
       :sau khi ấn thêm sẽ chuyển về trang xem
 -->
<?php
include('admin_header.php');
include('admin_sidebar.php');
?>

<div class="container">
    <div class="title">Thêm trình chiếu</div>
    <form action="admin_slider_add.php" method="post" enctype="multipart/form-data">
        <div class="form__group">
            <span>Ảnh</span>
            <input name="slider_image" type="file" />
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
if (isset($_POST['submit'])) {
       $slider_image = $_FILES['slider_image']['name'];
       // echo $slider_image;
       $temp_name = $_FILES['slider_image']['tmp_name'];
       move_uploaded_file($temp_name, "image/$slider_image");
       $sql = "INSERT into `slider` (slider_image) 
    values ('$slider_image')";
       $res = mysqli_query($con, $sql);
       if ($res) {
              echo "<script>alert('Ảnh được thêm thành công ')</script>";
              echo "<script>window.open('admin_slider_view.php','_self')</script>";
       }
}
?>