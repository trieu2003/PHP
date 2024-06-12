<?php
if (!isset($_SESSION)) session_start();
if(!isset($_SESSION['user'])) {
    header("location: login.php");
    exit();
}

$user = $_SESSION['user'];

// Phân trang dựa trên vai trò của người dùng
if ($user['role'] == 'admin') {
    header("Location: Admin/index.php");

} elseif ($user['role'] == 'teacher') {
    header("Location: Teacher/DangNhap/teacher.php");
    
} elseif ($user['role'] == 'student') {
    header("Location: student/index.php");
}
?>