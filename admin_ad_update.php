<!-- Phần sửa admin 
Yêu cầu :Khi ấn vào nút cập nhật admin thì sẽ cập nhật lại bảng ad
        :sau khi ấn cập nhật sẽ chuyển về trang xem
 -->
<?php
include('admin_header.php');
include('admin_sidebar.php');
?>

<form action="admin_ad_update.php" method="post" class="container">

    <div class="title">
        Chỉnh sửa quản trị viên
    </div>
    <table>
        <tr>
            <th>Email quản trị viên</th>
            <th>Pass quản trị viên</th>
            <th>Quyền hạn quản trị viên</th>
            <th>Cập nhật quản trị viên</th>
        </tr>
        <?php
                if (isset($_GET['ad_id'])) {
                        $ad_id = $_GET['ad_id'];
                        $sql = "SELECT * from `ad` where ad_id='$ad_id'";
                        $res = mysqli_query($con, $sql);
                        $row = mysqli_fetch_array($res);
                        $ad_email = $row['ad_email'];
                        $ad_pass = $row['ad_pass'];
                        $permission = $row['permission'];
                        echo "
                   <tr>
                       <td><input type='email' name='ad_email' value='$ad_email'></td>
                       <td><input type='text' name='ad_pass' value='$ad_pass'></td>
                       <td><input type='number' name='permission' value='$permission' max='3' min='1'></td>
                       <input type='hidden' name='ad_id' value='$ad_id'>                  
                       <td><input type='submit' name='submit' value='Gửi'></td>    
                   </tr>
                   ";
                }
                ?>
        <!-- else {
        echo "<script>
        window.open('admin_ad_view.php', '_self')
        </script>";
        } -->

    </table>
    </from>

    <?php
        include('admin_footer.php');
        ?>
    <?php
        if (isset($_POST['submit'])) {
                $ad_id = $_POST['ad_id'];
                $ad_email = $_POST['ad_email'];
                $ad_pass = $_POST['ad_pass'];
                $permission = $_POST['permission'];
                $sql = "UPDATE `ad` SET 
                ad_email='$ad_email',
                ad_pass='$ad_pass',
                permission='$permission'
                where ad_id='$ad_id'";
                $res = mysqli_query($con, $sql);
                if ($res) {
                    echo "<script>alert('Đổi thông tin người dùng thành công')</script>";
                    echo "<script>window.open('admin_login.php','_self')</script>";
                }
        }

        ?>