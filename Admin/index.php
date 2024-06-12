<?php
session_start();
if (isset($_SESSION['id_user']) && $_SESSION['role'] == 'admin') {
    include "../controller/admin_ctl.php";

    // Lấy thông tin admin
    $admin = getAdminInfo($user, $conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/style1.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<!-- Thanh menu -->
<?php include "navbar.php"; ?>
<!-- Hiển thị thông tin -->
<?php
if ($admin != 0) {
?>
<div class="container mt-5">
    <h1>Trang cá nhân quản lý</h1>
    <div class="row">
        <div class="col-4 card" style="width: 18rem;">
            <img src="../image/admin.png">
            <div class="card-body">
                <h5 class="card-title text-center">@<?= $admin['id_user'] ?></h5>
            </div>
        </div>
        <div class="col-8">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Họ và tên: <?= $admin['ten'] ?></li>
                <li class="list-group-item">Email: <?= $admin['email'] ?></li>
                <li class="list-group-item">Giới tính: <?= $admin['gioi_tinh'] ?></li>
                <li class="list-group-item">Ngày Sinh: <?= $admin['ngay_sinh'] ?></li>
                <li class="list-group-item">Địa chỉ: <?= $admin['dia_chi'] ?></li>
            </ul>
        </div>
    </div>
</div>
<?php
} else {
    header("Location: ../logout.php");
    exit;
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
// } else {
//     header("Location: ../login.php");
}
?>
