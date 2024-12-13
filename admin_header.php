<!--  Tách file từ file admin_index.php
Yêu cầu :Phải có phần kết nối với cơ sở dữ liệu
        :file có hàm session_start();
        :phải thêm điều kiện nếu chưa đăng nhập thì chuyển hướng sang file login.php (bổ sung sau khi có file login.php)
        :phải liên kết với icon,file css
 -->
<?php
session_start();
include('db.php');
if (!isset($_SESSION['ad_email'])) {
    header("location:admin_login.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ADMIN</title>
    <link rel="stylesheet" href="css/admin_style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="shortcut icon" href="image/favi.jpg" type="image/x-icon" />
</head>

<body>
    <div class="header">
        <div class="header__logo">Quản trị viên </div>
        <div class="header__user">
            <?php 
            echo $_SESSION['ad_email'];
            if (isset($_SESSION['ad_email'])) {
                $ad_email=$_SESSION['ad_email'];
                $sql = "SELECT * from `ad` where ad_email='$ad_email'";
                $res = mysqli_query($con, $sql);
                $row = mysqli_fetch_array($res);
                $permission= $row['permission'];
                echo " Quyền quản trị viên:".$permission;
            }
            ?>
        </div>
    </div>