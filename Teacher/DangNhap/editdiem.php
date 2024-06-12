<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Điểm</title>
</head>
<body>
    <h1>Edit Điểm Sinh Viên</h1>
    <form action="update_diem.php" method="POST">
        <label for="diemTL">Điểm Thường Luỹ:</label>
        <input type="text" name="diemTL" id="diemTL"><br><br>
        <label for="diemCK">Điểm Cuối Kỳ:</label>
        <input type="text" name="diemCK" id="diemCK"><br><br>
        <input type="hidden" name="id_sinh_vien" value="<?php echo $_GET['id_sinh_vien']; ?>">
        <input type="hidden" name="id_lhp" value="<?php echo $_GET['id_lhp']; ?>">
        <input type="submit" value="Lưu">
    </form>
</body>
</html>
