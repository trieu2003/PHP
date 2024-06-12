<?php
session_start();
if (isset($_SESSION['id_user']) && $_SESSION['role'] == 'admin') {
    include "../controller/admin_ctl.php";

    // Lấy thông tin admin
    $admin = getAdminInfo($user, $conn);

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        if (!empty($_POST['id_lh']) && !empty($_POST['tenLop'])) {
            $id_lh = $_POST['id_lh'];
            $tenLop = $_POST['tenLop'];

            $success = capNhatLopHoc($id_lh, $tenLop, $conn);

            if ($success) {
                header("Location: lophoc.php");
                exit;
            } else {
                $error_message = "Cập nhật lớp học không thành công.";
            }
        } else {
            $error_message = "Vui lòng điền đầy đủ thông tin.";
        }
    }

    if (isset($_GET['id_lh'])) {
        $id_lh = $_GET['id_lh'];
        $lop_hoc = getLopHocById($id_lh, $conn);

        if ($lop_hoc) {
            ?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Chỉnh sửa Lớp Học</title>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
                <link rel="stylesheet" href="../css/style.css">
                <link rel="icon" href="../imgs/icon.ico">
            </head>

            <body>
                <!-- Thanh menu -->
                <?php include "navbar.php"; ?>

                <div class="container mt-5">
                    <h2>Chỉnh sửa Lớp Học</h2>
                    <?php if (isset($error_message)) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error_message; ?>
                        </div>
                    <?php } ?>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id_lh=" . $id_lh; ?>">
                        <div class="mb-3">
                            <label for="id_lh" class="form-label">Mã lớp học:</label>
                            <input type="text" class="form-control" id="id_lh" name="id_lh" value="<?php echo $lop_hoc['id_lh']; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="tenLop" class="form-label">Tên lớp học:</label>
                            <input type="text" class="form-control" id="tenLop" name="tenLop" value="<?php echo $lop_hoc['tenLop']; ?>">
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
            </body>

            </html>
            <?php
        } else {
            echo "Không tìm thấy lớp học.";
        }
    } else {
        echo "ID lớp học không được cung cấp.";
    }
} else {
    header("Location: ../logout.php");
    exit;
}
?>
