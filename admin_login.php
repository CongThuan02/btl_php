<!-- Phần đăng nhập admin 
yêu cầu đăng nhập được ,hiện thị ra thông báo nếu sai
-->
<?php

session_start();
include('db.php')
?><div class="admin__login">
    <form method="post">
        <label>
            Email
        </label>
        <input type="text" name="ad_email" placeholder="Nhập Email">
        <label>
            Mật khẩu
        </label>
        <input type="password" name="ad_pass" placeholder="Nhập mật khẩu ">
        <button class="button" name="submit" type="submit">Đăng nhập</button>
    </form>
</div>
</div>
<?php
if (isset($_POST['submit'])) {
    $ad_email = $_POST['ad_email'];
    $ad_pass = md5($_POST['ad_pass']);
    $sql = "SELECT * FROM `ad` WHERE ad_email='$ad_email' AND ad_pass='$ad_pass'";
    $res = mysqli_query($con, $sql);
    $count = mysqli_num_rows($res);
    // echo  $sql;
    // nếu sai mật khẩu hoặc email thì thoát ra
    if ($count == 0) {
        echo "<script>alert('Email hoặc mật khẩu của bạn sai')</script>";
        exit();
    } else {
        $_SESSION['ad_email'] = $ad_email;
     
        echo "<script>alert('Bạn đã đăng nhập thành công')</script>";
        // echo " Xin chào: " . $_SESSION['ad_email'] . "";
        echo "<script>window.open('admin_index.php','_self')</script>";
    }
}
?>