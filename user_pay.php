<?php
include('sidebar.php');
?>
<div class="pay">

    <?php
    $user_email = $_SESSION['user_email'];
    $sql = "SELECT * FROM user WHERE user_email='$user_email'";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($res);
    $user_id = $row['user_id'];
    ?>
    <div class="pay__title">
        <h2>
            Chọn phương thức thanh toán
        </h2>
    </div>
    <a href="user_order.php?user_id=<?php echo $user_id ?>">
        Thanh toán ngoại tuyến
    </a>
    <a href="#.php">
        Thanh toán trực tuyến
        <img src="image/pay.png" alt="">
    </a>
</div>