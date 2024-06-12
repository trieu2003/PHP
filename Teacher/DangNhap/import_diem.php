<!-- Trang import_diem.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý điểm</title>
    <!-- Đường link đến file CSS -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Quản lý điểm</h1>
    
    <!-- Bảng hiển thị điểm -->
    <table class="table">
        <tr>
            <th>Sinh viên</th>
            <th>Môn học</th>
            <th>Điểm thành lập</th>
            <th>Điểm cuối kỳ</th>
            <th>Điểm tổng kết</th>
            <th>Thang điểm 4</th>
            <th>Điểm chữ</th>
            <th>Xếp loại</th>
            <th>Thao tác</th>
        </tr>
        <!-- PHP Code để lấy và hiển thị dữ liệu điểm từ cơ sở dữ liệu -->
        <?php
        require_once "../../connect.php";

        // Lấy id học kỳ từ request POST
        $id_hk = $_POST['id_hk'];

        // Truy vấn để lấy điểm từ bảng Diem dựa vào id học kỳ
        $query = "SELECT users.ten AS tenSV, monHoc.ten AS tenMonHoc, diem.diemTL, diem.diemCK, diem.diemTK, diem.thangDiem4, diem.diemChu, diem.xepLoai
                  FROM diem
                  JOIN users ON diem.id_sinh_vien = users.id_user
                  JOIN monHoc ON diem.id_mon_hoc = monHoc.id_mh
                  WHERE diem.id_hk = :id_hk";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id_hk', $id_hk, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $row) {
            echo "<tr>
                      <td>{$row['tenSV']}</td>
                      <td>{$row['tenMonHoc']}</td>
                      <td>{$row['diemTL']}</td>
                      <td>{$row['diemCK']}</td>
                      <td>{$row['diemTK']}</td>
                      <td>{$row['thangDiem4']}</td>
                      <td>{$row['diemChu']}</td>
                      <td>{$row['xepLoai']}</td>
                      <td>
                          <button onclick=\"editGrade('{$row['id_sinh_vien']}', '{$row['id_mon_hoc']}')\">Sửa</button>
                          <button onclick=\"deleteGrade('{$row['id_sinh_vien']}', '{$row['id_mon_hoc']}')\">Xoá</button>
                      </td>
                  </tr>";
        }
        ?>
    </table>

    <!-- Đoạn mã JavaScript -->
    <script>
        function editGrade(idSinhVien, idMonHoc) {
            // Chuyển hướng đến trang sửa điểm
            window.location.href = "edit_grade.php?id_sinh_vien=" + idSinhVien + "&id_mon_hoc=" + idMonHoc;
        }

        function deleteGrade(idSinhVien, idMonHoc) {
            // Hiển thị hộp thoại xác nhận xoá
            if (confirm("Bạn có chắc chắn muốn xoá điểm của sinh viên này không?")) {
                // Gửi yêu cầu xoá điểm thông qua Ajax hoặc chuyển hướng đến trang xử lý xoá
                window.location.href = "delete_grade.php?id_sinh_vien=" + idSinhVien + "&id_mon_hoc=" + idMonHoc;
            }
        }
    </script>
</body>
</html>
