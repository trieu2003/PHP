<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'teacher') {
    header("location: ../../login.php");
    exit();
}

require '../../connect.php';

$user = $_SESSION['user'];
$userId = $user['id_user'];

// Lấy thông tin các lớp học phần mà giáo viên này đang dạy
$sql = "SELECT lophocphan.id_lhp, lophocphan.id_lh, lophocphan.id_mh, lophocphan.id_hk, monhoc.ten AS ten_mh
        FROM lophocphan
        JOIN monhoc ON lophocphan.id_mh = monhoc.id_mh
        WHERE lophocphan.id_gv = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$userId]);
$lophocphans = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lớp học phần của giáo viên</title>
    <link rel="stylesheet" href="./CSS/stylegiaovien.css">
</head>
<body>
    <header>
        <h1>Lớp học phần của giáo viên</h1>
        <nav>
            <ul>
                <li><a href="teacher.php">Trang chủ</a></li>
                <li><a href="teacher_classes.php">Lớp học</a></li>
                <li><a href="teacher_grades.php">Điểm số</a></li>
                <li><a href="../../login.php">Tài khoản</a></li>
                <li><a href="../../logout.php">Đăng xuất</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>Lớp học phần</h2>
            <table>
                <thead>
                    <tr>
                        <th>Mã lớp học phần</th>
                        <th>Tên môn học</th>
                        <th>Học kỳ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lophocphans as $lhp): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($lhp['id_lhp']); ?></td>
                            <td><?php echo htmlspecialchars($lhp['ten_mh']); ?></td>
                            <td><?php echo htmlspecialchars($lhp['id_hk']); ?></td>
                            <td><a href="teacher_classes_detail.php?id_lhp=<?php echo htmlspecialchars($lhp['id_lhp']); ?>">Chi tiết</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Trường Đại học XYZ</p>
    </footer>
</body>
</html>
