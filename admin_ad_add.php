<!-- Phần thêm admin 
Yêu cầu:khi ấn vào nút thêm admin thì dữ liệu sẽ được thêm vào bảng ad sau khi ấn thêm sẽ chuyển về trang xem
-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<?php
include('admin_header.php');
include('admin_sidebar.php');
?>

<div class="container">
    <div class="title">Thêm Admin</div>
    <form action="admin_ad_add.php" method="post">
        <div class="form__group">
            <span>Email quản trị viên</span>
            <input name="ad_email" type="email" required />
        </div>
        <div class="form__group">
            <span>Mật khẩu quản trị viên</span>
            <input name="ad_pass" type="password" required />
        </div>
        <div class="form__group">
            <span>Quyền quản trị viên</span>
            <input name="permission" type="number" max="3" min="1" value="3" required />
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
    $ad_email = $_POST['ad_email'];
    $ad_pass = md5($_POST['ad_pass']);
    $permission = $_POST['permission'];

    $sql = "INSERT INTO `ad` (ad_email, ad_pass, permission) VALUES ('$ad_email', '$ad_pass', '$permission')";
    $res = mysqli_query($con, $sql);

    if ($res) {
        echo "<script>
                $(document).ready(function() {
                    toastr.success('Tài khoản được thêm thành công');
                    setTimeout(function() {
                        window.location.href = 'admin_ad_view.php';
                    }, 2000);
                });
              </script>";
    } else {
        echo "<script>
                $(document).ready(function() {
                    toastr.error('Có lỗi xảy ra, vui lòng thử lại.');
                });
              </script>";
    }
}
?>