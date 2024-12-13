<!-- Phần sửa mạng xã hội 
Yêu cầu :Khi ấn vào nút cập nhật mạng xã hội thì sẽ cập nhật lại bảng box
        :sau khi ấn cập nhật sẽ chuyển về trang xem
 -->
<?php
include('admin_header.php');
include('admin_sidebar.php');
?>

<form action="admin_network_update.php" method="post" class="container">

    <div class="title">
        Chỉnh sửa mạng xã hội
    </div>
    <table>
        <tr>
            <th>Tiêu đề mạng xã hội</th>
            <th>link mạng xã hội</th>
            <th>Cập nhật mạng xã hội</th>
        </tr>
        <?php
                if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $sql = "SELECT * from `network` where id='$id'";
                        $res = mysqli_query($con, $sql);
                        $row = mysqli_fetch_array($res);
                        $icon = $row['icon'];
                        $link = $row['link'];
                        echo "
                   <tr>
                       <td><input type='text' name='icon' value='$icon'></td>
                       <td><input type='text' name='link' value='$link'></td>
                       <input type='hidden' name='id' value='$id'>                  
                       <td><input type='submit' name='submit' value='Gửi'></td>    
                   </tr>
                   ";
                }
                ?>

    </table>
    </from>

    <?php
        include('admin_footer.php');
        ?>
    <?php
        if (isset($_POST['submit'])) {
                $id = $_POST['id'];
                $icon = $_POST['icon'];
                $link = $_POST['link'];
                $sql = "UPDATE `network` SET 
                icon='$icon',
                link='$link'
                where id='$id'";
                $res = mysqli_query($con, $sql);
                if ($res) {
                        echo "<script>alert('Đổi mạng xã hội dùng thành công')</script>";
                        echo "<script>window.open('admin_network_view.php','_self')</script>";
                }
        }        
?>