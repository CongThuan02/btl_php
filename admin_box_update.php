<!-- Phần sửa khối 
Yêu cầu :Khi ấn vào nút cập nhật khối thì sẽ cập nhật lại bảng box
        :sau khi ấn cập nhật sẽ chuyển về trang xem
 -->
<?php
include('admin_header.php');
include('admin_sidebar.php');
?>

<form action="admin_box_update.php" method="post" class="container">

    <div class="title">
        Chỉnh sửa khối
    </div>
    <table>
        <tr>
            <th>Tiêu đề khối</th>
            <th>Icon khối</th>
            <th>Cập nhật khối</th>
        </tr>
        <?php
                if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $sql = "SELECT * from `box` where id='$id'";
                        $res = mysqli_query($con, $sql);
                        $row = mysqli_fetch_array($res);
                        $title = $row['title'];
                        $icon = $row['icon'];
                        echo "
                   <tr>
                       <td><input type='text' name='title' value='$title'></td>
                       <td><input type='text' name='icon' value='$icon'></td>
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
                $title = $_POST['title'];
                $icon = $_POST['icon'];
                $permission = $_POST['permission'];
                $sql = "UPDATE `box` SET 
                title='$title',
                icon='$icon'
                where id='$id'";
                $res = mysqli_query($con, $sql);
                if ($res) {
                        echo "<script>alert('Đổi khối dùng thành công')</script>";
                        echo "<script>window.open('admin_box_view.php','_self')</script>";
                }
        }

        ?>