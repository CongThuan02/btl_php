<!-- Phần sửa trình chiếu
Yêu cầu :Khi ấn vào nút cập nhật trình chiếu thì sẽ cập nhật lại bảng slider
        :sau khi ấn cập nhật sẽ chuyển về trang xem
 -->
<?php
include('admin_header.php');
include('admin_sidebar.php');
?>

<form class="container" action="admin_slider_update.php" method="post" enctype="multipart/form-data">
    <div class="title">
        Chỉnh sửa trình chiếu
    </div>
    <table>
        <tr>
            <th>Ảnh trình chiếu </th>
            <th>Ảnh trình chiếu </th>
            <th>Cập nhật trình chiếu </th>
        </tr>
        <?php
                if (isset($_GET['slider_id'])) {
                        $slider_id = $_GET['slider_id'];
                        $sql = "SELECT * from `slider` where slider_id='$slider_id'";
                        $res = mysqli_query($con, $sql);
                        $row = mysqli_fetch_array($res);
                        $slider_image = $row['slider_image'];
                        echo "
                   <tr>
                       <td><img src='./image/$slider_image'></td>
                       <td><input type='file' name='slider_image' value='$slider_image'/></td>
                       <input type='hidden' name='slider_id' value='$slider_id'>                  
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
                $slider_id = $_POST['slider_id'];
                $slider_image = $_FILES['slider_image']['name'];
                $temp_name = $_FILES['slider_image']['tmp_name'];
                move_uploaded_file($temp_name, "./image/$slider_image");
                $sql = "UPDATE `slider` SET 
                slider_image='$slider_image'
                where slider_id='$slider_id'";
                $res = mysqli_query($con, $sql);
                echo $sql;
                if ($res) {
                        echo "<script>alert('Đổi trình chiếu thành công')</script>";
                        echo "<script>window.open('admin_slider_view.php','_self')</script>";
                }
        }

        ?>