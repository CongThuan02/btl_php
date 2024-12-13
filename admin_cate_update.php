<!-- Phần sửa danh mục sản phẩm 
Yêu cầu :Khi ấn vào nút cập nhật danh mục sản phẩm  thì sẽ cập nhật lại bảng categories
        :sau khi ấn cập nhật sẽ chuyển về trang xem
 -->
<?php
include('admin_header.php');
include('admin_sidebar.php');
?>

<form class="container" action="admin_cate_update.php" method="post">

    <div class="title">
        Chỉnh sửa danh mục sản phẩm
    </div>
    <table>
        <tr>
            <th>Tiêu đề danh mục sản phẩm</th>
            <th>Mô tả danh mục sản phẩm</th>
            <th>Cập nhật danh mục sản phẩm</th>
        </tr>
        <?php
                if (isset($_GET['cat_id'])) {
                        $cat_id = $_GET['cat_id'];
                        $sql = "SELECT * from `categories` where cat_id='$cat_id'";
                        $res = mysqli_query($con, $sql);
                        $row = mysqli_fetch_array($res);
                        $cat_title = $row['cat_title'];
                        $cat_desc = $row['cat_desc'];
                        echo "
                   <tr>
                       <td><input type='text' name='cat_title' value='$cat_title'></td>
                       <td><input type='text' name='cat_desc' value='$cat_desc'></td>
                       <input type='hidden' name='cat_id' value='$cat_id'>                  
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
                $cat_id = $_POST['cat_id'];
                $cat_title = $_POST['cat_title'];
                $cat_desc = $_POST['cat_desc'];
                $sql = "UPDATE `categories` SET 
                cat_title='$cat_title',
                cat_desc='$cat_desc'
                where cat_id='$cat_id'";
                $res = mysqli_query($con, $sql);
                echo $sql;
                if ($res) {
                        echo "<script>alert('Đổi danh mục sản phẩm thành công')</script>";
                        echo "<script>window.open('admin_cate_view.php','_self')</script>";
                }
        }

        ?>