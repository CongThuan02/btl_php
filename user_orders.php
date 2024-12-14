<?php
$active = 'Account';
include('header.php');
if (!isset($_SESSION['user_email'])) {
    echo "<script>window.open('checkout.php','_self')</script>";
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn đặt hàng</title>
    <style>
        /* General styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        /* Main container */
        .main {
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
        }

        /* Shop container */
        .shop {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
        }

        /* Title */
        .user__title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        /* Breadcrumb */
        .shop__breadcroumb {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .shop__breadcroumb li {
            display: inline;
        }

        .shop__breadcroumb li a {
            color: #007bff;
            text-decoration: none;
        }

        .shop__breadcroumb li a:hover {
            text-decoration: underline;
        }

        .shop__breadcroumb li:last-child {
            color: #333;
        }

        /* Table styling */
        .order-table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            margin-top: 20px;
        }

        .order-table thead {
            background-color: #007bff;
            color: #fff;
        }

        .order-table th,
        .order-table td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        .order-table tbody tr:hover {
            background-color: #f5f5f5;
        }

        /* Button styling */
        .info-btn {
            padding: 6px 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .info-btn:hover {
            background-color: #218838;
        }

        /* Disabled button */
        .info-btn.disabled {
            background-color: #d3d3d3; /* Màu xám */
            color: #a9a9a9; /* Màu chữ xám */
            cursor: not-allowed;
        }

        /* Sidebar */
        .user-sidebar {
            margin-right: 20px;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .shop__container {
                flex-direction: column;
                align-items: flex-start;
            }

            .order-table {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="main">
        <div class="shop">
            <div class="shop__container">
                <ul class="shop__breadcroumb">
                    <li><a href="index.php">Trang Chủ</a></li>
                    <li>Tài khoản</li>
                </ul>
                <?php
                include('user_sidebar.php');
                ?>
                <div class="user__content">
                    <div class="user__title">
                        Đơn đặt hàng
                    </div>
                    <table class="order-table">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Hóa đơn</th>
                                <th>Ngày liên hệ</th>
                                <th>Trạng thái</th>
                                <th>Thông tin liên hệ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $user_email = $_SESSION['user_email'];
                            $sql = "SELECT * FROM user WHERE user_email='$user_email'";
                            $res = mysqli_query($con, $sql);
                            $row = mysqli_fetch_array($res);
                            $user_id = $row['user_id'];
                            $sql_2 = "SELECT * FROM `order` WHERE user_id='$user_id'";
                            $res_2 = mysqli_query($con, $sql_2);
                            $i = 0;
                            while ($row_2 = mysqli_fetch_array($res_2)) {
                                $order_id = $row_2['order_id'];
                                $money = $row_2['money'];
                                $receipt = $row_2['receipt'];
                                $date = substr($row_2['date'], 0, 11);
                                $status = $row_2['status'];
                                $i++;
                                if ($status == 'pending') {
                                    $status = 'Chưa trả';
                                    $disabled_class = ''; // Không vô hiệu hóa nút
                                } else if ($status == 'Hoàn thành đơn') {
                                    $status = 'Hoàn thành đơn';
                                    $disabled_class = 'disabled'; // Vô hiệu hóa nút
                                } else {
                                    $status = 'Chờ nhận hàng';
                                    $disabled_class = ''; // Không vô hiệu hóa nút
                                }
                                echo "
                                    <tr>
                                        <td>$i</td>
                                        <td>$receipt</td>
                                        <td>$date</td>
                                        <td>$status</td>
                                        <td>
                                            <a href='user_order-pay.php?order_id=$order_id'>
                                                <button class='info-btn $disabled_class' " . ($disabled_class ? "disabled" : "") . ">
                                                    Thông tin liên hệ
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                ";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>
</body>
</html>