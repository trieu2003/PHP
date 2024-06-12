<?php
session_start();
if (isset($_SESSION['id_user']) && $_SESSION['role'] == 'admin') {
    include "../controller/admin_ctl.php";

    $admin = getAdminInfo($_SESSION['id_user'], $conn);

    $errors = array();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_mh = $_POST['id_mh'];
        $ten = $_POST['ten'];
        $so_tin_chi = $_POST['so_tin_chi'];

        $existing_subject = getMonHocById($id_mh, $conn);
        if ($existing_subject) {
            $errors['id_mh'] = "Mã môn học đã tồn tại.";
        }

        if (empty($id_mh)) {
            $errors['id_mh'] = "Vui lòng nhập mã môn học";
        }
        if (empty($ten)) {
            $errors['ten'] = "Vui lòng nhập tên môn học";
        }
        if (empty($so_tin_chi) || $so_tin_chi <= 0) {
            $errors['so_tin_chi'] = "Số tín chỉ phải lớn hơn 0";
        }

        if (empty($errors)) {
            $result = addSubject($id_mh, $ten, $so_tin_chi, $conn);

            if ($result) {
                header("Location: monhoc.php");
                exit;
            } else {
                $errors['general'] = "Thêm môn học không thành công.";
            }
        }
    }
} else {
    header("Location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thêm Môn Học</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="icon" href="../imgs/icon.ico">
</head>
<body>
  <!-- Thanh menu -->
  <?php include "navbar.php"; ?>

  <div class="container mt-5">
    <h2>Thêm Môn Học</h2>
    <form action="them_mh.php" method="post">
      <div class="mb-3">
        <label for="id_mh" class="form-label">Mã Môn Học</label>
        <input type="text" class="form-control" id="id_mh" name="id_mh" required>
        <?php if(isset($errors['id_mh'])) { echo "<div class='text-danger'>" . $errors['id_mh'] . "</div>"; } ?>
      </div>
      <div class="mb-3">
        <label for="ten" class="form-label">Tên Môn Học</label>
        <input type="text" class="form-control" id="ten" name="ten" required>
        <?php if(isset($errors['ten'])) { echo "<div class='text-danger'>" . $errors['ten'] . "</div>"; } ?>
      </div>
      <div class="mb-3">
        <label for="so_tin_chi" class="form-label">Số Tín Chỉ</label>
        <input type="number" class="form-control" id="so_tin_chi" name="so_tin_chi" required>
        <?php if(isset($errors['so_tin_chi'])) { echo "<div class='text-danger'>" . $errors['so_tin_chi'] . "</div>"; } ?>
      </div>
      <?php if(isset($errors['general'])) { echo "<div class='alert alert-danger' role='alert'>" . $errors['general'] . "</div>"; } ?>
      <button type="submit" class="btn btn-primary">Thêm Môn Học</button>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
