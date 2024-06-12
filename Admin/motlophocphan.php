<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_SESSION['id_user']) && $_SESSION['role'] == 'admin') {
    include "../controller/admin_ctl.php";

    // Kiểm tra nếu biến $user và $conn được định nghĩa
    if (!isset($user) || !isset($conn)) {
        die("Biến \$user hoặc \$conn chưa được định nghĩa.");
    }

    // Lấy thông tin admin
    $admin = getAdminInfo($user, $conn);

    if (isset($_GET['id_lhp']) && !empty($_GET['id_lhp'])) {
        $id_lhp = $_GET['id_lhp'];
        $lopHocPhan = getLopHocPhanById($id_lhp, $conn);

        if ($lopHocPhan) {
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style1.css">
    <link rel="icon" href="../imgs/icon.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <!-- Thanh menu -->
    <?php include "navbar.php"; ?>

    <!-- Hiển thị thông tin -->
    <div class="container mt-5 bg-light">
        <a class="btn btn-primary" href="themsv.php">Thêm sinh viên</a>
        <div class="table-responsive">
            <table class="table table-bordered mt-3 table-hover">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Mã Sinh Viên</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($lopHocPhan as $lop) {
                    ?>
                        <tr>
                            <th scope="row" class="col-2"><?php echo $i; $i++; ?></th>
                            <td scope="row" class="col-2"><?= $lop['ma_sv'] ?></td>
                            <!-- <td scope="row" class="col-2">
                                <a href="update_lh.php?id_lh=<?php echo $lop['id_lh'];?>" class="btn btn-warning btn-sm">Sửa</a>
                            </td> -->
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
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
    header("Location: ../login.php");
    exit;
}
