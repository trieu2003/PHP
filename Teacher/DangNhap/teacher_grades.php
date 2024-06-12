<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'teacher') {
    header("location: ../../login.php");
    exit();
}

require '../../connect.php';

$user = $_SESSION['user'];
$userId = $user['id_user'];

// Lấy danh sách lớp học phần
$sql = "SELECT lophocphan.id_lhp, lophocphan.id_mh, monhoc.ten AS ten_mh FROM lophocphan
        JOIN monhoc ON lophocphan.id_mh = monhoc.id_mh
        WHERE lophocphan.id_gv = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$userId]);
$lophocphans = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sua = $_GET['edit']??'false';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quản lý điểm sinh viên</title>
    <link rel="stylesheet" href="./CSS/stylegiaovien.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <header>
        <h1>Quản lý điểm sinh viên</h1>
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
            <h2>Chọn lớp học phần</h2>
            <form method="post">
                <label for="id_lhp">Lớp học phần:</label>
                <select id="id_lhp" name="id_lhp" required>
                    <?php foreach ($lophocphans as $lhp): ?>
                        <option value="<?php echo htmlspecialchars($lhp['id_lhp']); ?>">
                            <?php echo htmlspecialchars($lhp['id_mh'] . ' - ' . $lhp['ten_mh']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Xem điểm</button>
            </form>
        </section>

        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_lhp'])): ?>
            <?php
            $_SESSION['id_lhp'] = $_POST['id_lhp'];
            $id_lhp = $_POST['id_lhp'];
            $sql = "SELECT danhsachlophocphan.ma_sv, users.ten, diem.diemTL, diem.diemCK, diem.diemTK, diem.thangDiem4, diem.diemChu, diem.xepLoai
                    FROM danhsachlophocphan
                    JOIN users ON danhsachlophocphan.ma_sv = users.id_user
                    LEFT JOIN diem ON danhsachlophocphan.ma_sv = diem.id_sinh_vien AND danhsachlophocphan.id_lhp = diem.id_lhp
                    WHERE danhsachlophocphan.id_lhp = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id_lhp]);
            $sinhviens = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <section>
                <h2>Danh sách điểm</h2>
                  <table>
                    <thead>
                      <tr>
                            <th>Mã sinh viên</th>
                            <th>Tên sinh viên</th>
                            <th>Điểm thường xuyên</th>
                            <th>Điểm cuối kỳ</th>
                            <th>Điểm tổng kết</th>
                            <th>Điểm thang 4</th>
                            <th>Xếp loại</th>
                        </tr>
                    </thead>
                    <tbody id="mark-list-body">
                        <?php foreach ($sinhviens as $sv): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($sv['ma_sv']); ?></td>
                                <td><?php echo htmlspecialchars($sv['ten']); ?></td>
                                <?php
                                if ($sua == "true") {
                                    ?>
                                    <td><input type="number" name="" id="" min="0" max="10" step="0.1" value="<?php echo isset($sv['diemTL']) ? htmlspecialchars($sv['diemTL']) : ''; ?>"></td>
                                    <td><input type="number" name="" id="" min="0" max="10" step="0.1" value="<?php echo isset($sv['diemCK']) ? htmlspecialchars($sv['diemCK']) : ''; ?>"></td>
                                    <?php
                                } else {
                                    ?>
                                    <td><?php echo isset($sv['diemTL']) ? htmlspecialchars($sv['diemTL']) : ''; ?></td>
                                    <td><?php echo isset($sv['diemCK']) ? htmlspecialchars($sv['diemCK']) : ''; ?></td>
                                    <?php
                                }                                
                                ?>
                                <td><?php echo isset($sv['diemTK']) ? htmlspecialchars($sv['diemTK']) : ''; ?></td>
                                <td><?php echo isset($sv['thangDiem4']) ? htmlspecialchars($sv['thangDiem4']) : ''; ?></td>
                                <td><?php echo isset($sv['xepLoai']) ? htmlspecialchars($sv['xepLoai']) : ''; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div id="btn-save" style="margin-top:10px">
                    <a class="btn btn-secondary" href="teacher_grades.php?edit=true">Sửa</a>
                    <!-- <a class="btn btn-primary" href="teacher_grades.php?edit=false">Lưu</a> -->
                    <!-- <a class="btn btn-primary" onclick="sendData()">Lưu</a> -->
                    <button class="btn btn-primary" id="btnSubmitData">Lưu</button>
                </div>
            </section>
            <script>
                $(document).ready(function() {
                    $("#btnSubmitData").click(function() {
                        var tableData = []; // Mảng để lưu trữ dữ liệu bảng

                        // Lặp qua tất cả các hàng trong bảng
                        $("table tr").each(function(index, row) {
                        // Bỏ qua hàng tiêu đề
                        if (index === 0) return;

                        var rowData = {}; // Lưu trữ dữ liệu của một hàng

                        // Lấy dữ liệu từ mỗi ô trong hàng
                        $(row).find("td").each(function(index, cell) {
                            var dataKey = $(cell).index(); // Lấy chỉ mục ô (0, 1, 2)
                            var dataValue = $(cell).text(); // Lấy nội dung ô

                            // Kiểm tra nếu ô có thẻ input
                            if ($(cell).find("input").length > 0) {
                                    dataValue = $(cell).find("input").val(); // Lấy giá trị input
                            }

                            // Thêm dữ liệu vào object rowData
                            rowData[dataKey] = dataValue;
                        });

                        // Thêm dữ liệu hàng vào mảng tableData
                        tableData.push(rowData);
                        });

                    // Update the URL path dynamically
                    const currentUrl = new URL(window.location.href);
                    currentUrl.searchParams.set('edit', 'false');
                    const updatedUrl = currentUrl.toString();

                    // Update the URL using window.history.replaceState()
                    window.history.replaceState({}, '', updatedUrl);

                    $('#mark-list-body').html('');
                        // Gửi dữ liệu đến server bằng AJAX
                        $.ajax({
                        url: "save-markList.php", // Thay thế bằng URL script xử lý trên server
                        type: "POST",
                        data: {
                            tableData: JSON.stringify(tableData) // Chuyển đổi mảng sang JSON
                        },
                        success: function(response) {
                            $('#mark-list-body').html(response);
                        },
                        error: function(error) {
                            console.error(error);
                        }
                        });
                    });
                    });
            </script>
        <?php endif; ?>
    </main>
    <footer>
        <p>© 2024 Trường Đại học XYZ</p>
    </footer>
</body>
</html>
