<?php
session_start();
require_once "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Kiểm tra mật khẩu và xác nhận mật khẩu khớp nhau
    if ($password === $confirm_password) {
        // Hash mật khẩu
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Cập nhật mật khẩu mới vào cơ sở dữ liệu
        $sql = "UPDATE users SET password = ? WHERE otp_verified = TRUE";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$hashed_password]);

        // Đặt lại các cờ xác minh OTP
        $sql = "UPDATE users SET otp = NULL, otp_verified = FALSE WHERE otp_verified = TRUE";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // Chuyển hướng đến trang đăng nhập
        header("Location: login.php");
        exit;
    } else {
        $error = "Mật khẩu và Xác Nhận Mật Khẩu không khớp.";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt Lại Mật Khẩu</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
           
            background-image: url('./image/hinhnenmaytinh.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        
        }
        .container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-control {
            border-radius: 5px;
        }
        .btn {
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Đặt Lại Mật Khẩu</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group">
                <label for="password">Mật Khẩu Mới:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Xác Nhận Mật Khẩu:</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div> 
            <button  type="submit" class="btn btn-primary">Đặt Lại</button>
        </form>
        <?php if(isset($error)): ?>
            <div class="alert alert-danger mt-3" role="alert"><?php echo $error; ?></div>
        <?php endif; ?>
    </div>
</body>
</html>


