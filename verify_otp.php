<?php
session_start();
require_once "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $otp = $_POST['otp'];

    // Kiểm tra xác thực mã OTP
    $sql = "SELECT * FROM users WHERE otp = ? AND otp_verified = FALSE";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$otp]);
    $user = $stmt->fetch();

    if ($user) {
        // Đánh dấu OTP đã được xác minh
        $sql = "UPDATE users SET otp_verified = TRUE WHERE id_user = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$user['id_user']]);

        // Chuyển hướng đến trang đặt lại mật khẩu
        header("Location: reset_password.php");
        exit;
    } else {
        $error = "OTP không hợp lệ.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác Minh OTP</title>
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
                        <h2 class="text-center mb-4">Xác Minh OTP</h2>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <div class="form-group">
                                <label for="otp">OTP:</label>
                                <input type="text" id="otp" name="otp" class="form-control" required>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary btn-block">Xác Minh</button>
                        </form>
                        <?php if(isset($error)) echo "<p class='text-danger mt-3'>$error</p>"; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
