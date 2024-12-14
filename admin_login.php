<?php
session_start();
include('db.php');

$error_message = ''; // Biến để lưu thông báo lỗi
if (isset($_POST['submit'])) {
    $ad_email = $_POST['ad_email'];
    $ad_pass = md5($_POST['ad_pass']);
    $sql = "SELECT * FROM `ad` WHERE ad_email='$ad_email' AND ad_pass='$ad_pass'";
    $res = mysqli_query($con, $sql);
    $count = mysqli_num_rows($res);

    if ($count == 0) {
        $error_message = 'Email hoặc mật khẩu của bạn sai';
    } else {
        $_SESSION['ad_email'] = $ad_email;
        echo "<script>
                Toastify({
                    text: 'Đăng nhập thành công!',
                    duration: 3000, // Thời gian hiển thị (3 giây)
                    close: true, // Có nút đóng
                    gravity: 'top', // Vị trí xuất hiện (top hoặc bottom)
                    position: 'right', // Vị trí bên phải hay trái
                    backgroundColor: 'linear-gradient(to right, #00b09b, #96c93d)' // Màu nền toast
                }).showToast();
              </script>";
        echo "<script>window.open('admin_index.php','_self')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Admin</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .admin__login {
            background: #fff;
            padding: 20px 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 100%;
            max-width: 400px;
        }
        .admin__login form {
            display: flex;
            flex-direction: column;
        }
        .admin__login label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .admin__login input {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        .admin__login button[type="submit"] {
            padding: 10px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .admin__login button[type="submit"]:hover {
            background: #0056b3;
        }
        .checkbox-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .error-message {
            color: red;
            margin-top: 10px;
            font-size: 14px;
        }
    </style>
    <!-- Thêm Toastify CDN -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</head>
<body>
    <div class="admin__login">
        <form method="post">
            <label>Email</label>
            <input type="text" name="ad_email" placeholder="Nhập Email" required>
            <label>Mật khẩu</label>
            <input type="password" id="ad_pass" name="ad_pass" placeholder="Nhập mật khẩu" required>
            <div class="checkbox-container">
                <input type="checkbox" id="showPassword" onclick="togglePassword()">
                <label for="showPassword">Hiển thị mật khẩu</label>
            </div>
            <button class="button" name="submit" type="submit">Đăng nhập</button>
            <?php if ($error_message != ''): ?>
                <div class="error-message">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
        </form>
    </div>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('ad_pass');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        }
    </script>
</body>
</html>