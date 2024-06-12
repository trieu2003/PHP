<?php
session_start();
if (isset($_SESSION['id_user']) && $_SESSION['role'] == 'admin') {
    include "../controller/admin_ctl.php";

    $admin = getAdminInfo($user, $conn);

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        if (!empty($_POST['id_mh']) && !empty($_POST['ten']) && !empty($_POST['so_tin_chi'])) {
            $id_mh = $_POST['id_mh'];
            $ten_mh = $_POST['ten']; // Corrected variable name
            $so_tin_chi = $_POST['so_tin_chi'];

            $success = updateMonHoc($id_mh, $ten_mh, $so_tin_chi, $conn); // Corrected variable name

            if ($success) {
                header("Location: monhoc.php");
                exit;
            } else {
                $error_message = "Cập nhật môn học không thành công.";
            }
        } else {
            $error_message = "Vui lòng điền đầy đủ thông tin.";
        }
    }

    // Check if subject ID is provided in the URL
    if (isset($_GET['id_mh'])) {
        $id_mh = $_GET['id_mh'];

        // Get subject information by ID
        $mon_hoc = getMonHocById($id_mh, $conn);

        // Check if subject exists
        if ($mon_hoc) {
            ?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Chỉnh sửa Môn Học</title>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
                <link rel="stylesheet" href="../css/style.css">
                <link rel="icon" href="../imgs/icon.ico">
            </head>

            <body>
                <!-- Navigation menu -->
                <?php include "navbar.php"; ?>

                <div class="container mt-5">
                    <h2>Chỉnh sửa Môn Học</h2>
                    <?php if (isset($error_message)) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error_message; ?>
                        </div>
                    <?php } ?>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="mb-3">
                            <label for="id_mh" class="form-label">Mã môn học:</label>
                            <input type="text" class="form-control" id="id_mh" name="id_mh" value="<?php echo $mon_hoc['id_mh']; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="ten" class="form-label">Tên môn học:</label>
                            <input type="text" class="form-control" id="ten" name="ten" value="<?php echo $mon_hoc['ten']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="so_tin_chi" class="form-label">Số tín chỉ:</label>
                            <input type="number" class="form-control" id="so_tin_chi" name="so_tin_chi" value="<?php echo $mon_hoc['so_tin_chi']; ?>">
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
            </body>

            </html>
        <?php
    } else {
        echo "Không tìm thấy môn học.";
    }
} else {
    echo "Mã môn học không được cung cấp.";
}
} else {
    header("Location: ../logout.php");
    exit;
}

?>
