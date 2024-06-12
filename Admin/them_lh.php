<?php
session_start();
if (isset($_SESSION['id_user']) && $_SESSION['role'] == 'admin') {
    include "../controller/admin_ctl.php";

    $admin = getAdminInfo($user, $conn);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_lh = $_POST['id_lh'];
        $tenLop = $_POST['tenLop'];


        $result = themLopHoc($id_lh, $tenLop, $conn);

        if ($result) {
        
            header("Location: lophoc.php");
            exit;
        } else {
            // Nếu thêm không thành công, hiển thị thông báo lỗi
            echo "Có lỗi xảy ra. Vui lòng thử lại.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Lớp Học</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../imgs/icon.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <!-- Thanh menu -->
    <?php include "navbar.php"; ?>

    <!-- Form thêm lớp học -->
    <div class="container mt-5">
        <h2>Thêm Lớp Học</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mb-3">
                <label for="id_lh" class="form-label">Mã Lớp Học</label>
                <input type="text" class="form-control" id="id_lh" name="id_lh" required>
            </div>
            <div class="mb-3">
                <label for="tenLop" class="form-label">Tên Lớp Học</label>
                <input type="text" class="form-control" id="tenLop" name="tenLop" required>
            </div>
            <button type="submit" class="btn btn-primary">Thêm Lớp Học</button>
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
