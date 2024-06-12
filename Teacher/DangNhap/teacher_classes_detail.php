<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'teacher') {
    header("location: ../../login.php");
    exit();
}

require '../../connect.php';

$user = $_SESSION['user'];

if (!isset($_GET['id_lhp'])) {
    header("location: teacher_classes.php");
    exit();
}

$id_lhp = $_GET['id_lhp']; // Make sure this line is not commented out

// Lấy thông tin lớp học phần
$sql = "SELECT lophocphan.*, monhoc.ten AS ten_mh, lophoc.tenLop AS ten_lop, users.ten AS ten_gv
        FROM lophocphan
        JOIN monhoc ON lophocphan.id_mh = monhoc.id_mh
        JOIN lophoc ON lophocphan.id_lh = lophoc.id_lh
        JOIN users ON lophocphan.id_gv = users.id_user
        WHERE lophocphan.id_lhp = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id_lhp]);
$lophocphan = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$lophocphan) {
    header("location: teacher_classes.php");
    exit();
}

// Lấy danh sách sinh viên trong lớp học phần
$sql = "SELECT users.id_user, users.ten FROM danhsachlophocphan
        JOIN users ON danhsachlophocphan.ma_sv = users.id_user
        WHERE danhsachlophocphan.id_lhp = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id_lhp]);
$sinhviens = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Xử lý thêm sinh viên
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_student'])) {
    $new_student_id = $_POST['new_student_id'];
    
    // Kiểm tra xem sinh viên đã tồn tại trong lớp chưa
    $stmt = $conn->prepare("SELECT COUNT(*) FROM danhsachlophocphan WHERE id_lhp = ? AND ma_sv = ?");
    $stmt->execute([$id_lhp, $new_student_id]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        // Hiển thị thông báo nếu sinh viên đã tồn tại trong lớp
        $error_msg = "Sinh viên đã tồn tại trong lớp.";
    } else {
        // Kiểm tra xem mã sinh viên có tồn tại trong cơ sở dữ liệu không
        $stmt = $conn->prepare("SELECT * FROM users WHERE id_user = ?");
        $stmt->execute([$new_student_id]);
        $student = $stmt->fetch();

        if ($student) {
            // Thêm sinh viên vào lớp
            $stmt = $conn->prepare("INSERT INTO danhsachlophocphan (id_lhp, ma_sv) VALUES (?, ?)");
            $stmt->execute([$id_lhp, $new_student_id]);
            header("location: teacher_classes_detail.php?id_lhp=$id_lhp");
            exit();
        } else {
            // Hiển thị thông báo nếu mã sinh viên không tồn tại
            $error_msg = "Sinh viên không tồn tại trong cơ sở dữ liệu.";
        }
    }
}

// Xử lý xóa sinh viên
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_student'])) {
    $delete_student_id = $_POST['delete_student_id'];
    $stmt = $conn->prepare("DELETE FROM danhsachlophocphan WHERE id_lhp = ? AND ma_sv = ?");
    $stmt->execute([$id_lhp, $delete_student_id]);
    header("location: teacher_classes_detail.php?id_lhp=$id_lhp");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết lớp học phần</title>
    <link rel="stylesheet" href="./CSS/stylegiaovien.css">
</head>
<body>
    <header>
        <h1>Chi tiết lớp học phần</h1>
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
        <section class="class-detail">
            <h2>Thông tin lớp học phần</h2>
            <div>
                <p><strong>Mã lớp học phần:</strong> <?php echo htmlspecialchars($lophocphan['id_lhp']); ?></p>
                <p><strong>Môn học:</strong> <?php echo htmlspecialchars($lophocphan['ten_mh']); ?></p>
                <p><strong>Lớp học:</strong> <?php echo htmlspecialchars($lophocphan['ten_lop']); ?></p>
                <p><strong>Giáo viên:</strong> <?php echo htmlspecialchars($lophocphan['ten_gv']); ?></p>
            </div>
        </section>

        <section class="student-list">
            <h2>Danh sách sinh viên</h2>
            <table>
                <tr>
                    <th>Mã sinh viên</th>
                    <th>Tên sinh viên</th>
                    <th>Hành động</th>
                </tr>
                <?php foreach ($sinhviens as $sinhvien): ?>
                <tr>
                    <td><?php echo htmlspecialchars($sinhvien['id_user']); ?></td>
                    <td><?php echo htmlspecialchars($sinhvien['ten']); ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="delete_student_id" value="<?php echo htmlspecialchars($sinhvien['id_user']); ?>">
                            <button type="submit" name="delete_student">Xóa</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </section>

        <section class="add-student">
            <h2>Thêm sinh viên</h2>
            <?php if (isset($error_msg)): ?>
                <p style="color: red;"><?php echo htmlspecialchars($error_msg); ?></p>
            <?php endif; ?>
            <form method="post">
                <label for="new_student_id">Mã sinh viên:</label>
                <input type="text" id="new_student_id" name="new_student_id" required>
                <button type="submit" name="add_student">Thêm</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Trường Đại học XYZ</p>
    </footer>
</body>
</html>
