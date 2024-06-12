<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'teacher') {
    header("location: ../../login.php");
    exit();
}

$user = $_SESSION['user'];

// Phân trang dựa trên vai trò của người dùng
if ($user['role'] == 'admin') {
    header("location: ../../Admin/index.php");
} elseif ($user['role'] == 'teacher') {
    header("location: teacher.php");
} elseif ($user['role'] == 'student') {
    header("location:../../student/index.php");
    
}
?>
