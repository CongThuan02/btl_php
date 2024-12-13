<!-- Phần thêm khối 
Yêu cầu:khi ấn vào nút thêm khối thì dữ liệu sẽ được thêm vào bảng box
       :sau khi ấn thêm sẽ chuyển về trang xem
-->

<?php
include('admin_header.php');
include('admin_sidebar.php');
?>

<div class="container">
    <div class="title">Thêm khối</div>
    <form action="admin_box_add.php" method="post">
        <div class="form__group">
            <span>Tiêu đề</span>
            <input name="title" type="text" required />
        </div>
        <div class="form__group">
            <span>Icon</span>
            <input name="icon" type="text" required />
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
    $title = $_POST['title'];
    // echo $title;
    $icon = $_POST['icon'];
    // echo  $icon;
    $sql = "INSERT into `box` (title,icon) 
    values ('$title','$icon')";
    $res = mysqli_query($con, $sql);
    if ($res) {
        echo "<script>alert('Khối được thêm thành công ')</script>";
        echo "<script>window.open('admin_box_view.php','_self')</script>";
    }
}
?>