<?php
session_start();
if (isset($_SESSION['id_user']) && $_SESSION['role'] == 'admin') {
    include "../controller/admin_ctl.php";
    $admin = getAdminInfo($_SESSION['id_user'], $conn);
    $classes = getClasses($conn);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Process the form submission
        $id_user = $_POST['id_user'];
        $password = $_POST['password'];
        $ten = $_POST['ten'];
        $email = $_POST['email'];
        $gioi_tinh = $_POST['gioi_tinh'];
        $ngay_sinh = $_POST['ngay_sinh'];
        $dia_chi = $_POST['dia_chi'];
        $hinh_the = $_FILES['hinh_the'];
        $ma_lop = $_POST['ma_lop'];
        $khoa = $_POST['khoa'];
        $role = $_POST['role'];
        
       // Mã hóa mật khẩu
       $hashed_password = password_hash($password, PASSWORD_DEFAULT);

       try {
           if (themTaiKhoan($id_user, $hashed_password, $role, $ten, $email, $gioi_tinh, $ngay_sinh, $dia_chi, $hinh_the, $ma_lop, $khoa, $conn)) {
               echo "<script>alert('User added successfully!'); window.location.href = 'taikhoan.php';</script>";
           }
       } catch (PDOException $e) {
           if ($e->getCode() == '23000' && strpos($e->getMessage(), 'Duplicate entry') !== false) {
               echo "<script>alert('Username already exists. Please choose a different one.');</script>";
           } else {
               echo "<script>alert('An error occurred. Please try again later.');</script>";
           }
       }
       
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thêm Tài Khoản</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
  <script>
    function validateForm() {
        var id_user = document.getElementById('id_user').value;
        var password = document.getElementById('password').value;
        var email = document.getElementById('email').value;

        if (id_user == "" || password == "" || email == "") {
            alert("Please fill out all required fields.");
            return false;
        }
        return true;
    }
  </script>
</head>
<body>
  <div class="container mt-5">
    <h1>Thêm tài khoản</h1>

    <form action="them_taikhoan.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">
      <div class="mb-3">
        <label for="id_user" class="form-label">Tên đăng nhập</label>
        <input type="text" class="form-control" id="id_user" name="id_user" required>
        <div id="id_user-error" class="text-danger"></div>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Mật khẩu</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <div class="mb-3">
        <label for="ten" class="form-label">Họ và Tên</label>
        <input type="text" class="form-control" id="ten" name="ten" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <div class="mb-3">
        <label for="gioi_tinh" class="form-label">Giới tính</label>
        <select class="form-select" id="gioi_tinh" name="gioi_tinh" required>
          <option value="Nam">Nam</option>
          <option value="Nữ">Nữ</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="ngay_sinh" class="form-label">Ngày sinh</label>
        <input type="date" class="form-control" id="ngay_sinh" name="ngay_sinh" required>
      </div>
      <div class="mb-3">
        <label for="dia_chi" class="form-label">Địa chỉ</label>
        <input type="text" class="form-control" id="dia_chi" name="dia_chi" required>
      </div>
      <div class="mb-3">
        <label for="hinh_the" class="form-label">Hình Thẻ</label>
        <input type="file" class="form-control" id="hinh_the" name="hinh_the" required>
      </div>
      <div class="mb-3">
        <label for="ma_lop" class="form-label">Mã Lớp</label>
        <select class="form-select" id="ma_lop" name="ma_lop" required>
          <?php foreach ($classes as $class): ?>
            <option value="<?php echo $class['id_lh']; ?>"><?php echo $class['tenLop']; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="mb-3">
        <label for="khoa" class="form-label">Khoa</label>
        <input type="text" class="form-control" id="khoa" name="khoa" required>
      </div>
      <div class="mb-3">
        <label for="role" class="form-label">Vai trò</label>
        <select class="form-select" id="role" name="role" required>
          <option value="admin">Quản trị viên</option>
          <option value="teacher">Giảng viên</option>
          <option value="student">Sinh viên</option>
        </select>
      </div>

      <button type="submit" class="btn btn-primary">Thêm</button>
    </form>
  </div>
</body>

</html>
<?php
} else {
    echo "<script>alert('Unauthorized access!'); window.location.href = 'logout.php';</script>";
    //không hiểu

}
?>
