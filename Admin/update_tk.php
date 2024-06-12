<?php
session_start();
if (isset($_SESSION['id_user']) && $_SESSION['role'] == 'admin') {
    include "../controller/admin_ctl.php";
    $admin = getAdminInfo($user, $conn);

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        if (!empty($_POST['id_user']) && !empty($_POST['ten']) && !empty($_POST['email']) && !empty($_POST['gioi_tinh']) && !empty($_POST['ngay_sinh']) && !empty($_POST['dia_chi']) && !empty($_POST['hinh_the']) && !empty($_POST['ma_lop']) && !empty($_POST['khoa']) && !empty($_POST['role'])) {
            $id_user = $_POST['id_user'];
            $ten = $_POST['ten'];
            $email = $_POST['email'];
            $gioi_tinh = $_POST['gioi_tinh'];
            $ngay_sinh = $_POST['ngay_sinh'];
            $dia_chi = $_POST['dia_chi'];
            $hinh_the = $_POST['hinh_the'];
            $ma_lop = $_POST['ma_lop'];
            $khoa = $_POST['khoa'];
            $role = $_POST['role'];

            $success = updateTaiKhoan($id_user, $ten, $email, $gioi_tinh, $ngay_sinh, $dia_chi, $hinh_the, $ma_lop, $khoa, $role, $conn);

            if ($success) {
                header("Location: taikhoan.php");
                exit;
            } else {
                $error_message = "Cập nhật tài khoản không thành công.";
            }
        } else {
            $error_message = "Vui lòng điền đầy đủ thông tin.";
        }
    }

    if (isset($_GET['id_user'])) {
        $id_user = $_GET['id_user'];
        $user = getUserById($id_user, $conn);

        if ($user) {
            ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật Tài khoản</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/style1.css">
    <link rel="icon" href="../imgs/icon.ico">
</head>
<body>
    <?php include "navbar.php"; ?>

    <div class="container mt-5">
        <h2>Cập nhật Tài khoản</h2>
        <?php if (isset($error_message)) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error_message; ?>
                        </div>
                    <?php } ?>

        <?php if ($user) { ?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
                <div class="mb-3">
                <label for="id_user" class="form-label">Mã người dùng:</label>
                <input type="text"  class="form-control" name="id_user" value="<?php echo $user['id_user']; ?>" readonly>
                <div class="mb-3">
                    <label for="ten" class="form-label">Họ và Tên:</label>
                    <input type="text" class="form-control" id="ten" name="ten" value="<?php echo $user['ten']; ?>">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>">
                </div>
                <div class="mb-3">
                    <label for="gioi_tinh" class="form-label">Giới tính:</label>
                    <select class="form-select" id="gioi_tinh" name="gioi_tinh">
                        <option value="Nam" <?php if ($user['gioi_tinh'] === 'Nam') echo 'selected'; ?>>Nam</option>
                        <option value="Nữ" <?php if ($user['gioi_tinh'] === 'Nữ') echo 'selected'; ?>>Nữ</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="ngay_sinh" class="form-label">Ngày sinh:</label>
                    <input type="date" class="form-control" id="ngay_sinh" name="ngay_sinh" value="<?php echo $user['ngay_sinh']; ?>">
                </div>
                <div class="mb-3">
                    <label for="dia_chi" class="form-label">Địa chỉ:</label>
                    <input type="text" class="form-control" id="dia_chi" name="dia_chi" value="<?php echo $user['dia_chi']; ?>">
                </div>
                <div class="mb-3">
                    <label for="hinh_the" class="form-label">Hình Thẻ:</label>
                    <input type="text" class="form-control" id="hinh_the" name="hinh_the" value="<?php echo $user['hinh_the']; ?>">
                </div>
                <div class="mb-3">
                    <label for="ma_lop" class="form-label">Mã Lớp:</label>
                    <input type="text" class="form-control" id="ma_lop" name="ma_lop" value="<?php echo $user['ma_lop']; ?>">
                </div>
                <div class="mb-3">
                    <label for="khoa" class="form-label">Khoa:</label>
                    <input type="text" class="form-control" id="khoa" name="khoa" value="<?php echo $user['khoa']; ?>">
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Vai trò:</label>
                    <select class="form-select" id="role" name="role">
                        <option value="admin" <?php if ($user['role'] === 'admin') echo 'selected'; ?>>Admin</option>
                        <option value="teacher" <?php if ($user['role'] === 'teacher') echo 'selected'; ?>>Teacher</option>
                        <option value="student" <?php if ($user['role'] === 'student') echo 'selected'; ?>>Student</option>
                    </select>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Cập nhật</button>
            </form>
        <?php } ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
        } else {
            $error_message = "Không tìm thấy tài khoản.";
        }
    } else {
        $error_message = "Mã người dùng không được cung cấp.";
    }
} else {
    header("Location: ../logout.php");
    exit;
}
?>
