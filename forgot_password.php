<?php
session_start();
require_once "connect.php"; // Kết nối cơ sở dữ liệu
require 'Teacher/vendor/autoload.php'; // Bao gồm autoloader của Composer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Kiểm tra xem email có tồn tại trong cơ sở dữ liệu hay không
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        // Tạo OTP ngẫu nhiên
        $otp = mt_rand(100000, 999999);

        // Lưu OTP vào cơ sở dữ liệu
        $sql = "UPDATE users SET otp = ?, otp_verified = FALSE WHERE id_user = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$otp, $user['id_user']]);

        // Gửi OTP đến email sử dụng PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Cài đặt máy chủ
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Máy chủ SMTP của Gmail
            $mail->SMTPAuth = true;
            $mail->Username = 'gamecntt843@gmail.com'; // SMTP username
            $mail->Password = 'chrb ivps ptwj yfvy'; // SMTP password (Đảm bảo bảo mật, sử dụng biến môi trường hoặc cách khác để bảo mật thông tin)
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Người nhận
            $mail->setFrom('gamecntt843@gmail.com', 'GameCNTT Support');
            $mail->addAddress($email);

            // Nội dung email
            $mail->isHTML(true);
            $mail->Subject = 'Mã OTP của bạn';
            $mail->Body = "Mã OTP của bạn là: <b>$otp</b>
            Chúc bạn 1 ngày tốt lành
            ";

            $mail->send();
            // Chuyển hướng đến trang xác minh OTP
            header("Location: verify_otp.php");
            exit;
        } catch (Exception $e) {
            echo "Không thể gửi email. Lỗi Mailer: {$mail->ErrorInfo}";
        }
    } else {
        $error = "Email không tồn tại trong hệ thống.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên Mật Khẩu</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
         body {
            background-image: url('./image/hinhnenmaytinh.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Quên Mật Khẩu</h2>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary btn-block">Gửi OTP</button>
                        </form>
                        <?php if(isset($error)) echo "<p class='text-danger mt-3'>$error</p>"; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

