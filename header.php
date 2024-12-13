<?php
// để dùng $_SESSION
session_start();
include('db.php');
include('functions.php')
?>

<!DOCTYPE html>
<html lang="en">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css'
    integrity='sha512-vZWT27aGmde93huNyIV/K7YsydxaafHLynlJa/4aPy28/R1a/IxewUH4MWo7As5I33hpQ7JS24kwqy/ciIFgvg=='
    crossorigin='anonymous' />

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car auto</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="image/favi.jpg" type="image/x-icon">

</head>

<body>
    <div class="header">
        <div class="header__container">
            <div class="header__left">
                <a href="#" class="header__btn">
                    <?php
                    if (!isset($_SESSION['user_email'])) {
                        echo "Xin chào";
                    } else {
                        echo " Xin chào: " . $_SESSION['user_email'] . "";
                    }
                    ?>
                </a>
                <a href="checkout.php">
                    <?php
                    $ip_add = getRealIpUser();
                    $sql = "select * from cart where ip_add='$ip_add'";
                    $res = mysqli_query($con, $sql);
                    $count = mysqli_num_rows($res);
                    echo $count;
                    ?>
                    mặt hàng trong giỏ hàng của bạn | Tổng giá:
                    <?php
                    $total = 0;
                    $ip_add = getRealIpUser();
                    $sql = "select * from cart where ip_add='$ip_add'";
                    $res = mysqli_query($con, $sql);
                    while ($row = mysqli_fetch_array($res)) {
                        $product_id = $row['p_id'];
                        $qty = $row['qty'];
                        $sql_2 = "select * from product where product_id='$product_id'";
                        $res_2 = mysqli_query($con, $sql_2);
                        while ($row_2 = mysqli_fetch_array($res_2)) {
                            $sub_total = $row_2['product_price'] * $qty;
                            $total += $sub_total;
                        }
                    }

                    echo $total;
                    ?>
                    Triệu
                </a>
            </div>
            <div class="header__right">
                <ul class="header__list">
                    <li class="header__item">
                        <a href="register.php" class="header__link">
                            Đăng ký
                        </a>
                    </li>
                    <li class="header__item">
                        
                    </li>
                    <li class="header__item">
                        <a href="cart.php" class="header__link">
                            Giỏ hàng
                        </a>
                    </li>

                    <li class="header__item">
                        <?php
                        if (!isset($_SESSION['user_email'])) {
                            echo " <a href='checkout.php' class='header__link'>
                            Đăng nhập
                            </a>";
                        } else {
                            echo " <a href='user_logout.php' class='header__link'>
                            Đăng xuất
                            </a>";
                        }
                        ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="navbar">
        <input type="checkbox" id="checkbox">
        <label for="checkbox" class="navbar__check">
            <i class="fa fa-bars"></i>
        </label>
        <div class="navbar__logo">
            <a href="index.php">
                <img src="image/logos.png" alt="">
            </a>
        </div>
        <div class="navbar__nav">
            <ul class="nav__list">
                <!-- thêm class -->
                <li class="nav__item">
                    <a href="index.php" class="nav__link <?php if ($active == 'Home') echo "active"; ?>">
                        Trang chủ
                    </a>
                </li>
                <li class="nav__item">
                    <a href="shop.php" class="nav__link <?php if ($active == 'Shop') echo "active"; ?>">
                        Cửa Hàng
                    </a>
                </li>
                <li class="nav__item">
                    <a href="user_orders.php" class="nav__link <?php if ($active == 'Account') echo "active"; ?>">
                        Tài Khoản
                    </a>
                </li>
                <li class="nav__item">
                    <a href="cart.php" class="nav__link <?php if ($active == 'Cart') echo "active"; ?>">
                        Giỏ Hàng
                        <span>
                            <?php echo $count; ?>
                        </span>
                    </a>
                </li>
                <li class="nav__item">
                    <a href="contact.php" class="nav__link <?php if ($active == 'Contact') echo "active"; ?>">
                        Liên hệ
                    </a>
                </li>
            </ul>
        </div>
        <div class="navbar__search">
            <form action="" method="post" class="navbar__form">
                <input type="text" name="search" class="navbar__input" placeholder="Tìm kiếm">
                <input type="submit" name="search__submit" class="navbar__submit">
            </form>
            <?php
            if (isset($_POST['search__submit'])) {
                $search = $_POST['search'];
                $_SESSION['search'] = $search;
                echo "<script>window.open('search.php','_self')</script>";
            }
            ?>
        </div>

    </div>