<?php
session_start();
if (isset($_SESSION['id_user']) && $_SESSION['role'] == 'admin') {
    include "../controller/admin_ctl.php";

    // Lấy thông tin admin
    $admin = getAdminInfo($user, $conn);

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        if (!empty($_POST['id_hk']) && !empty($_POST['ten_hk']) && !empty($_POST['Nam_hoc'])) {
            $id_hk = $_POST['id_hk'];
            $ten_hk = $_POST['ten_hk'];
            $nam_hoc = $_POST['Nam_hoc'];

            $success = updateHocKy($id_hk, $ten_hk, $Nam_hoc, $conn);

            if ($success) {
                header("Location: hocky.php");
                exit;
            } else {
                $error_message = "Cập nhật học kì không thành công.";
            }
        } else {
            $error_message = "Vui lòng điền đầy đủ thông tin.";
        }
    }

   if (isset($_GET['id_hk'])) {
        $id_hk = $_GET['id_hk'];

        // Đảm bảo id_hk không rỗng
        if (!empty($id_hk)) {
            $hoc_ki = getHocKiById($id_hk, $conn);

            // Kiểm tra xem hoc_ki có được tìm thấy không
            if ($hoc_ki) {
?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Chỉnh sửa Học kì</title>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
                <link rel="stylesheet" href="../css/style.css">
                <link rel="icon" href="../imgs/icon.ico">
            </head>

            <body>
                <!-- Thanh menu -->
                <?php include "navbar.php"; ?>

                <div class="container mt-5">
                    <h2>Chỉnh sửa Học kì</h2>
                    <?php if (isset($error_message)) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error_message; ?>
                        </div>
                    <?php } ?>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="mb-3">
                            <label for="id_hk" class="form-label">Mã học kì:</label>
                            <input type="text" class="form-control" id="id_hk" name="id_hk" value="<?php echo $hoc_ki['id_hk']; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="ten_hk" class="form-label">Tên học kỳ:</label>
                            <input type="text" class="form-control" id="ten_hk" name="ten_hk" value="<?php echo $hoc_ki['ten_hk']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="nam_hoc" class="form-label">Năm học:</label>
                            <input type="text" class="form-control" id="nam_hoc" name="nam_hoc" value="<?php echo $hoc_ki['Nam_hoc']; ?>">
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
            </body>

            </html>
<?php
            } else {
                echo "Không tìm thấy học kì.";
            }
        } else {
            echo "ID học kì không được cung cấp.";
        }
    } else {
        echo "ID học kì không được cung cấp.";
    }
} else {
    header("Location: ../logout.php");
    exit;
}
?>
