<?php
// Gọi header.php để hiển thị menu bar
require_once "header.php";
// Kiểm tra vai trò của người dùng
session_start();
if (!isset($_SESSION['user'])) {
    // Nếu chưa đăng nhập, chuyển hướng người dùng đến trang đăng nhập
    header("location: ../../login.php");
    exit();
}

// Nội dung của trang Dashboard cho Admin, Giáo viên, và Sinh viên
echo "Xin chào, " . $_SESSION['user']['ten'] . "!";
?>
