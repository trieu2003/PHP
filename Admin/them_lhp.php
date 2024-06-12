<?php
session_start();
if (isset($_SESSION['id_user']) && $_SESSION['role'] == 'admin') {
    include "../controller/admin_ctl.php";

    $admin = getAdminInfo($_SESSION['id_user'], $conn);


    $monHocList = getMonHocList($conn);
    $giangVienList = getGiangVienList($conn);


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_lhp = $_POST['id_lhp'];
        $id_lh = $_POST['id_lh'];
        $id_mh = $_POST['id_mh'];
        $id_gv = $_POST['id_gv'];
        $id_hk = $_POST['id_hk'];

        $result = themLopHocPhan($id_lhp, $id_lh, $id_mh, $id_gv, $id_hk, $conn);

        if ($result) {

            header("Location: lophocphan.php");
            exit;
        } else {
            $error_message = "Có lỗi xảy ra. Vui lòng thử lại.";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm lớp học phần</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../imgs/icon.ico">
</head>
<body>
    <!-- Thanh menu -->
    <?php include "navbar.php"; ?>

    <div class="container mt-5">
        <h2>Thêm lớp học phần</h2>
        <?php if (isset($error_message)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_message; ?>
            </div>
        <?php } ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="mb-3">
                <label for="id_lhp" class="form-label">Mã lớp học phần:</label>
                <input type="text" class="form-control" id="id_lhp" name="id_lhp" required>
            </div>
            <div class="mb-3">
                <label for="id_lh" class="form-label">Mã lớp học:</label>
                <input type="text" class="form-control" id="id_lh" name="id_lh" required>
            </div>
            <div class="mb-3">
                <label for="id_mh" class="form-label">Mã môn học:</label>
                <select class="form-select" id="id_mh" name="id_mh" required>
                    <option value="">Chọn mã môn học</option>
                    <?php foreach ($monHocList as $monHoc) { ?>
                        <option value="<?= $monHoc['id_mh']; ?>"><?= $monHoc['ten']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_gv" class="form-label">Mã giảng viên:</label>
                <select class="form-select" id="id_gv" name="id_gv" required>
                    <option value="">Chọn mã giảng viên</option>
                    <?php foreach ($giangVienList as $giangVien) { ?>
                        <option value="<?= $giangVien['id_user']; ?>"><?= $giangVien['ten']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_hk" class="form-label">Mã học kỳ:</label>
                <input type="text" class="form-control" id="id_hk" name="id_hk" required>
            </div>
            <button type="submit" class="btn btn-primary">Thêm</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
} else {
    header("Location: ../logout.php");
    exit;
}
?>
