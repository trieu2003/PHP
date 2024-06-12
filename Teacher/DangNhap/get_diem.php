<?php
// Kết nối cơ sở dữ liệu
require_once "../../connect.php";

// Lấy id học kỳ từ request POST
$id_hk = $_POST['id_hk'];


// Sửa từ Diem.id_hk thành Diem.id_lhp
$query = "SELECT diem.diemTL, diem.diemCK, diem.diemTK, diem.thangDiem4, diem.diemChu, diem.xepLoai
FROM diem
WHERE diem.id_sinh_vien = :id_sinh_vien AND diem.id_lhp = :id_lhp";


$stmt = $conn->prepare($query);
$stmt->bindParam(':id_hk', $id_hk, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<table class='table'>";
echo "<tr>
          <th>Sinh viên</th>
          <th>Môn học</th>
          <th>Điểm thành lập</th>
          <th>Điểm cuối kỳ</th>
          <th>Điểm tổng kết</th>
          <th>Thang điểm 4</th>
          <th>Điểm chữ</th>
          <th>Xếp loại</th>
          <th>Thao tác</th>
      </tr>";
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
                <button onclick=\"editDiem('{$row['tenSV']}', '{$row['tenMonHoc']}', '{$row['diemTL']}', '{$row['diemCK']}', '{$row['diemTK']}', '{$row['thangDiem4']}', '{$row['diemChu']}', '{$row['xepLoai']}')\">Sửa</button>
                <button onclick=\"deleteDiem('{$row['tenSV']}', '{$row['tenMonHoc']}')\">Xóa</button>
              </td>
          </tr>";
}
echo "</table>";
?>

<script>
    function editDiem(tenSV, tenMonHoc, diemTL, diemCK, diemTK, thangDiem4, diemChu, xepLoai) {
        // Mở modal sửa điểm và điền dữ liệu
        document.getElementById('edit-tenSV').value = tenSV;
        document.getElementById('edit-tenMonHoc').value = tenMonHoc;
        document.getElementById('edit-diemTL').value = diemTL;
        document.getElementById('edit-diemCK').value = diemCK;
        document.getElementById('edit-diemTK').value = diemTK;
        document.getElementById('edit-thangDiem4').value = thangDiem4;
        document.getElementById('edit-diemChu').value = diemChu;
        document.getElementById('edit-xepLoai').value = xepLoai;
        // Hiển thị modal sửa điểm
        $('#editModal').modal('show');
    }

    function deleteDiem(tenSV, tenMonHoc) {
        if (confirm(`Bạn có chắc chắn muốn xóa điểm của sinh viên ${tenSV} môn ${tenMonHoc} không?`)) {
            // Gửi yêu cầu xóa điểm qua Ajax
            $.ajax({
                type: 'POST',
                url: 'delete_diem.php',
                data: {
                    tenSV: tenSV,
                    tenMonHoc: tenMonHoc
                },
                success: function(response) {
                    // Load lại trang sau khi xóa thành công
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Đã xảy ra lỗi, vui lòng thử lại sau.');
                }
            });
        }
    }
</script>
