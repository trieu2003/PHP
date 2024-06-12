<?php
// Kết nối đến cơ sở dữ liệu
include '../../connect.php';

// Lấy dữ liệu từ biểu mẫu chỉnh sửa điểm
$id_sinh_vien = $_POST['id_sinh_vien'];
$id_lhp = $_POST['id_lhp'];
$diemTL = $_POST['diemTL'];
$diemCK = $_POST['diemCK'];

// Cập nhật điểm trong cơ sở dữ liệu
$sql = "UPDATE diem SET diemTL=?, diemCK=? WHERE id_sinh_vien=? AND id_lhp=?";
$stmt = $conn->prepare($sql);
$stmt->execute([$diemTL, $diemCK, $id_sinh_vien, $id_lhp]);

// Chuyển hướng trở lại trang quản lý điểm sinh viên
header("Location: teacher.php");
exit();
?>
