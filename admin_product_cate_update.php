<!-- Phần sửa thể loại 
Yêu cầu :Khi ấn vào nút cập nhật thể loại  thì sẽ cập nhật lại bảng product_categories
        :sau khi ấn cập nhật sẽ chuyển về trang xem
 -->
<?php
include('admin_header.php');
include('admin_sidebar.php');
?>

<form class="container" action="admin_product_cate_update.php" method="post">

    <div class="title">
        Chỉnh sửa thể loại
    </div>
    <table>
        <tr>
            <th>Tiêu đề thể loại </th>
            <th>Mô tả thể loại </th>
            <th>Cập nhật thể loại </th>
        </tr>
        <?php
                if (isset($_GET['p_cat_id'])) {
                        $p_cat_id = $_GET['p_cat_id'];
                        $sql = "SELECT * from `product_categories` where p_cat_id='$p_cat_id'";
                        $res = mysqli_query($con, $sql);
                        $row = mysqli_fetch_array($res);
                        $p_cat_title = $row['p_cat_title'];
                        $p_cat_desc = $row['p_cat_desc'];
                        echo "
                   <tr>
                       <td><input type='text' name='p_cat_title' value='$p_cat_title'></td>
                       <td><input type='text' name='p_cat_desc' value='$p_cat_desc'></td>
                       <input type='hidden' name='p_cat_id' value='$p_cat_id'>                  
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
                $p_cat_id = $_POST['p_cat_id'];
                $p_cat_title = $_POST['p_cat_title'];
                $p_cat_desc = $_POST['p_cat_desc'];
                $sql = "UPDATE `product_categories` SET 
                p_cat_title='$p_cat_title',
                p_cat_desc='$p_cat_desc'
                where p_cat_id='$p_cat_id'";
                $res = mysqli_query($con, $sql);
                echo $sql;
                if ($res) {
                        echo "<script>alert('Đổi thể loại thành công')</script>";
                        echo "<script>window.open('admin_product_cate_view.php','_self')</script>";
                }
        }

        ?>