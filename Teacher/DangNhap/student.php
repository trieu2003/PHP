<?php
session_start();
require_once "../../connect.php";

// Kiểm tra xem người dùng đã đăng nhập chưa
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'teacher') {
    header("location: ../../login.php");
    exit();
}

$id_user = $_SESSION['id_user'];

// Lấy thông tin của sinh viên
$stmt = $conn->prepare("SELECT * FROM Users WHERE id_user = ?");
$stmt->execute([$id_user]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

// Lấy điểm của sinh viên
$query = "SELECT monHoc.ten AS tenMonHoc, diem.diemTL, diem.diemCK, diem.diemTK, diem.thangDiem4, diem.diemChu, diem.xepLoai
          FROM diem
          JOIN donHoc ON diem.id_mon_hoc = monHoc.id_mh
          WHERE diem.id_sinh_vien = ?";
$stmt = $conn->prepare($query);
$stmt->execute([$id_user]);
$grades = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bảng điểm sinh viên</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Bảng điểm sinh viên</h2>
        <h4>Xin chào, <?php echo $student['ten']; ?>!</h4>
        <h5>Điểm của bạn:</h5>
        <table class="table">
            <thead>
                <tr>
                    <th>Môn học</th>
                    <th>Điểm thành lập</th>
                    <th>Điểm cuối kỳ</th>
                    <th>Điểm tổng kết</th>
                    <th>Thang điểm 4</th>
                    <th>Điểm chữ</th>
                    <th>Xếp loại</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($grades as $grade): ?>
                <tr>
                    <td><?php echo $grade['tenMonHoc']; ?></td>
                    <td><?php echo $grade['diemTL']; ?></td>
                    <td><?php echo $grade['diemCK']; ?></td>
                    <td><?php echo $grade['diemTK']; ?></td>
                    <td><?php echo $grade['thangDiem4']; ?></td>
                    <td><?php echo $grade['diemChu']; ?></td>
                    <td><?php echo $grade['xepLoai']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="../../logout.php" class="btn btn-danger">Đăng xuất</a>
    </div>
</body>
</html>
