<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Define an array to store validation errors
$errors = [];

if (isset($_SESSION['id_user']) && $_SESSION['role'] == 'admin') {
    include "../controller/admin_ctl.php";

    // Lấy thông tin 
    $admin = getAdminInfo($user, $conn);

    function loadClass($c){
        include "class/$c.php";
    }
    spl_autoload_register('loadClass');

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        // Perform form validation
        if (empty($_POST['id_hk'])) {
            $errors['id_hk'] = "Vui lòng nhập mã học kì";
        }
        if (empty($_POST['ten_hk'])) {
            $errors['ten_hk'] = "Vui lòng nhập tên học kì";
        }
        if (empty($_POST['nam_hoc'])) {
            $errors['nam_hoc'] = "Vui lòng nhập năm học";
        }

        // If there are no validation errors, proceed with storing the data
        if (empty($errors)) {
            $hocky = new hocky();
            $n = $hocky->store();

            if ($n == -1) {
                $errors['id_hk'] = "Mã học kì đã tồn tại";
            } elseif ($n == 0) {
                echo "<script>alert('Khong them duoc'); window.history.go(-1);</script>";
                exit;
            } elseif ($n == 1) {
                echo "<script>alert('Da them...'); window.location='hocky.php';</script>";
                exit;
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../imgs/icon.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <!-- Thanh menu -->
    <?php include "navbar.php"; ?>

    <!-- Hiển thị thông tin -->
    <div class="container mt-5">
        <h2>Thêm Học Kì</h2>
        <form method="post" action="them_hk.php">
            <div class="mb-3">
                <label for="id_hk" class="form-label">Mã học kì:</label>
                <input type="text" class="form-control" id="id_hk" name="id_hk">
                <?php if(isset($errors['id_hk'])) { echo "<div class='text-danger'>" . $errors['id_hk'] . "</div>"; } ?>
                
            </div>
            <div class="mb-3">
                <label for="ten_hk" class="form-label">Tên học kì:</label>
                <input type="text" class="form-control" id="ten_hk" name="ten_hk">
                <?php if(isset($errors['ten_hk'])) { echo "<div class='text-danger'>" . $errors['ten_hk'] . "</div>"; } ?>
            </div>
            <div class="mb-3">
                <label for="nam_hoc" class="form-label">Năm học:</label>
                <input type="text" class="form-control" id="nam_hoc" name="nam_hoc">
                <?php if(isset($errors['nam_hoc'])) { echo "<div class='text-danger'>" . $errors['nam_hoc'] . "</div>"; } ?>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Thêm Học Kì</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
} else {
    header("Location: ../logout.php");
    exit;
}
?>
