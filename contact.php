<!-- Phần liên hệ
Yêu cầu :Gửi ý kiến phản hồi qua gmail bằng hàm mail()
        :Tự động phản hồi gmail bằng hàm mail()
Bug:Đã gửi nhưng admin chưa nhận được gmail
-->
<?php
$active = 'Contact';
include('header.php');
?>
<div class="main">
    <div class="shop">
        <div class="shop__container">
            <ul class="shop__breadcroumb">
                <li><a href="index.php">Trang Chủ</a></li>
                <li>Liên hệ</li>
            </ul>
            <?php
            include('sidebar.php');
            ?>
            <div class="contact">
                <div class="contact__title">
                    <h1>Liên hệ </h1>
                    <span>Hãy liên hệ với chúng tôi 24/7</span>
                </div>
                <form action="contact.php" method="post" class="contact__form">
                    <label>
                        Tên
                    </label>
                    <input type="text" placeholder="Nhập tên của bạn" name="name">
                    <label>
                        Email
                    </label>
                    <input type="email" placeholder="Nhập Email" name="email">
                    <label>
                        Chủ đề
                    </label>
                    <input type="text" placeholder="Nhập chủ đề" name="subject">
                    <label>
                        Nội dung
                    </label>
                    <textarea type="text" placeholder="Nhập nội dung" name="message"></textarea>
                    <button type="submit" name="submit">Gửi</button>
                </form>
                <?php
                if (isset($_POST['submit'])) {

                    // Nhận tin nhắn từ gmail
                    $name = $_POST['name'];
                    $receiver = "phuonghole121201@gmail.com";
                    $subject = $_POST['subject'];
                    $message = $_POST['message'];
                    $email = $_POST['email'];
                    $sql = "INSERT INTO `contact`(name,subject,message,email)
                        VALUES ('$name','$subject','$message','$email')
                        ";
                    $res = mysqli_query($con, $sql);
                    // echo  $sql;
                    if (mail($receiver, $subject, $message, $email)) {
                        echo "<h2> Tin nhắn của quý khách đã gửi thành công $email</h2>";
                    } else {
                        echo "Xin lỗi! hệ thống chưa nhậc được phản hồi của quý khách";
                    }
                    // tự động phản hồi đến email của khách hàng
                    $subject = "Xin chào quý khách";
                    $message = "Cảm ơn vì đã gửi tin nhắn cho chúng tôi. CÀNG SỚM CÀNG TỐT, chúng tôi sẽ trả lời tin nhắn của bạn";
                    mail($email, $subject, $message, $receiver);


                    // hàm email()
                    // https://www.codingnepalweb.com/configure-xampp-to-send-mail-from-localhost/
                    // file php.ini 
                    //     Chỉ dành cho Win32.
                    // http : //php.net/smtp
                    // SMTP = smtp.gmail.com
                    // http : //php.net/smtp-port
                    // smtp_port = 587
                    // sendmail_from = your_email_address_here
                    // sendmail_path = "\" C: \ xampp \ sendmail \ sendmail.exe \ "-t"
                    // sendmain.ini
                    // smtp_server = smtp.gmail.com
                    // smtp_port = 587
                    // error_logfile = error.log
                    // debug_logfile = debug.log
                    // auth_username = your_email_address_here
                    // auth_password = your_password_here
                    // force_sender = your_email_address_here

                } ?>


            </div>
        </div>

    </div>

</div>

<?php

include('footer.php');

?>