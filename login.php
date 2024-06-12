<?php
if (!isset($_SESSION)) session_start();
require_once('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Truy vấn dựa trên tên đăng nhập để lấy thông tin người dùng
    $stmt = $conn->prepare("SELECT * FROM users WHERE id_user = :id_user");
    $stmt->bindParam(':id_user', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Kiểm tra mật khẩu đã nhập với mật khẩu đã mã hóa trong cơ sở dữ liệu
        if (password_verify($password, $user['password'])) {
            // Mật khẩu chính xác, đăng nhập thành công
            $_SESSION['user'] = $user;
            $_SESSION['role'] = $user['role'];
            $_SESSION['id_user'] = $user['id_user'];
            header("Location: includer.php");
            exit();
        } else {
            $error = "Invalid username or password";
        }
    } else {
        $error = "Invalid username or password";
    }
}
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('image/hinhnen.png');
            background-size: cover;
            background-position: center;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-form {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 350px;
        }
        .login-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .btn-primary {
            width: 100%;
        }
        .mt-3 {
            margin-top: 15px;
        }
        .text-center {
            text-align: center;
        }
        .text-danger {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 login-form">
                <h2>Đăng Nhập</h2>
                <!--<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">-->
                <form method="post" action="login.php">
                    <div class="form-group">
                        <label for="username">Tên đăng nhập:</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mật khẩu:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Đăng Nhập</button>
                </form>
                <a href="logout.php" class="mt-3 d-block text-center">Về trang chủ</a>
                <a href="forgot_password.php" class="mt-3 d-block text-center">Quên mật khẩu?</a>
                <?php if(isset($error)): ?>
                    <p class="text-danger mt-3"><?php echo $error; ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS và jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
