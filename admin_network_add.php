<!-- Phần thêm mạng xã hội 
Yêu cầu:khi ấn vào nút mạng xã hội thì dữ liệu sẽ được thêm vào bảng network
       :sau khi ấn thêm sẽ chuyển về trang xem
-->
<?php
include('admin_header.php');
include('admin_sidebar.php');
?>

<div class="container">
    <div class="title">Thêm mạng xã hội</div>
    <form action="admin_network_add.php" method="post" enctype="multipart/form-data">
        <div class="form__group">
            <span>Icon mạng xã hội</span>
            <input name="icon" type="text" required />
        </div>
        <div class="form__group">
            <span>Link mạng xã hội</span>
            <input name="link" type="text" required />
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
    $icon = $_POST['icon'];
    // echo $icon;
    $link = $_POST['link'];
    // echo  $link;
    $sql = "INSERT INTO `network` (icon,link) 
       VALUES ('$icon','$link')";
    $res = mysqli_query($con, $sql);
    if ($res) {
        echo "<script>alert('Mạng xã hội được thêm thành công ')</script>";
        echo "<script>window.open('admin_network_view.php','_self')</script>";
    }
}
?>