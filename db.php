<!-- Phần kết nối cơ sở dữ liệu
Yêu cầu :Nếu không kết nối được thì in ra lỗi
        :Nếu kết nối thành công in ra thành công 
-->
<?php
// $con = mysqli_connect("localhost","id18038931_btl4",'Y*Q$Pm9dt3rb@^C+',"id18038931_btl");
$con = mysqli_connect("localhost", "root", "root", "btl");
if ($con->connect_error) {
  die("Lỗi: " . $con->connect_error);
}
//   echo "Thành công";
?>