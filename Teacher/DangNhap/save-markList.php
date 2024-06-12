<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'teacher') {
    header("location: ../../login.php");
    exit();
}

require '../../connect.php';
$id_lhp = $_SESSION['id_lhp'];

$tableDataJSON = $_POST['tableData'];
$tableData = json_decode($tableDataJSON, true); // Giải mã JSON sang mảng

foreach ($tableData as $row) {
  if (!empty($row[2]) && !empty($row[3])) {
    $row[4] = number_format($row[2]*0.3 + $row[3]*0.7, 1);
    $sql = "UPDATE diem 
            SET diemTL=$row[2], diemCK=$row[3], diemTK=$row[4] 
            Where id_sinh_vien=$row[0] and id_lhp=$id_lhp";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
  } else if (empty($row[2]) && !empty($row[3])) {
    $row[4] = $row[3];
    $sql = "UPDATE diem 
            SET diemCK=$row[3], diemTK=$row[4] 
            Where id_sinh_vien=$row[0] and id_lhp=$id_lhp";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
  }    
}
            $sql = "SELECT danhsachlophocphan.ma_sv, users.ten, diem.diemTL, diem.diemCK, diem.diemTK, diem.thangDiem4, diem.diemChu, diem.xepLoai
                    FROM danhsachlophocphan
                    JOIN users ON danhsachlophocphan.ma_sv = users.id_user
                    LEFT JOIN diem ON danhsachlophocphan.ma_sv = diem.id_sinh_vien AND danhsachlophocphan.id_lhp = diem.id_lhp
                    WHERE danhsachlophocphan.id_lhp = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id_lhp]);
            $sinhviens = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Duyệt qua dữ liệu bảng
foreach ($sinhviens as $item) {
  echo "<tr>";
    echo "<td>" . $item['ma_sv'] . "</td>";
    
    
    echo "<td>" . $item['ten'] . "</td>";
    
    
    echo "<td>" . $item['diemTL'] . "</td>";
    
    
    echo "<td>" . $item['diemCK'] . "</td>";
    
    
    echo "<td>" . $item['diemTK'] . "</td>";
    
    
    echo "<td>" . $item['thangDiem4'] . "</td>";
    
    
    echo "<td>" . $item['xepLoai'] . "</td>";
    echo "</tr>";
}
?>