<?php
session_start();
if (isset($_SESSION['id_user']) && $_SESSION['role'] == 'admin') {
    include "../controller/admin_ctl.php";

    // Lấy thông tin admin
    $admin = getAdminInfo($user, $conn);
 
    $role_filter = isset($_GET['role']) ? $_GET['role'] : '';
    if ($role_filter != '') {
        $taikhoan = getTaiKhoanByRole($role_filter, $conn);
    } else {
        $taikhoan = getTaiKhoan($conn);
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
    <link rel="stylesheet" href="../CSS/style1.css">
    <link rel="icon" href="../imgs/icon.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php include "navbar.php"; ?>

    <div class="container mt-5 bg-light">
        <center><h1>Danh sách tài khoản</h1></center>   
        
        <!-- Thanh tìm kiếm -->
        <div class="row mt-3">
            <div class="col-md-6 offset-md-3">
                <form id="searchForm" action="" method="GET" class="d-flex">
                    <select id="roleSelect" name="role" class="form-select me-2" aria-label="Chọn vai trò">
                        <option value="">Chọn vai trò</option>
                        <option value="admin" <?php echo ($role_filter == 'admin') ? 'selected' : ''; ?>>Admin</option>
                        <option value="teacher" <?php echo ($role_filter == 'teacher') ? 'selected' : ''; ?>>Teacher</option>
                        <option value="student" <?php echo ($role_filter == 'student') ? 'selected' : ''; ?>>Student</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </form>
            </div>
        </div>

        <!-- Hiển thị thông tin tài khoản -->
        <a class="btn btn-primary" href="them_taikhoan.php">Thêm tài khoản</a>
        <?php
       if (isset($taikhoan) && $taikhoan != 0)   {
        ?>
            <div class="table-responsive">
                <table class="table table-sm  table-bordered mt-3  table-hover">
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Tên đăng nhập </th>
                            <th scope="col">Vai Trò</th>
                            <!-- <th scope="col">mật khẩu</th> -->
                            <th scope="col">Họ và Tên</th>
                            <th scope="col">Email</th>
                            <th scope="col">Giới tính</th>
                            <th scope="col">Ngày sinh</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col">Hình Thẻ</th>
                            <th scope="col">Mã Lớp</th>
                            <th scope="col">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($taikhoan as $g) { 
                            ?>
                            <tr>
                                <th scope="row" class="col">
                                    <?php echo $i;
                                    $i++; ?>
                                </th>
                                <td scope="row" class="col"><?= $g['id_user'] ?></td>
                                <!-- <td scope="row" class="col"><?= $g['password'] ?></td> -->
                                <td scope="row" class="col"><?= $g['role'] ?></td>
                                <td scope="row" class="col"><?= $g['ten'] ?></td>
                                <td scope="row" class="col"><?= $g['email'] ?></td>
                                <td scope="row" class="col"><?= $g['gioi_tinh'] ?></td>
                                <td scope="row" class="col"><?= $g['ngay_sinh'] ?></td>
                                <td scope="row" class="col"><?= $g['dia_chi'] ?></td>
                                <td scope="row" class="col">
                                    <img src="../image/<?php echo $g['hinh_the'] ?>"  alt="...">
                                </td>
                                <td scope="row" class="col"><?= $g['ma_lop'] ?></td>
                               
                                <td scope="row" >
                                    <a href="update_tk.php?id_user=<?php echo $g['id_user'];?>" class="btn btn-warning btn-sm">Sửa</a>
                                </td>

                            </tr>
                        <?php } ?>
                    </tbody>
                    <tbody>

                    </tbody>
                </table>
            </div>
        <?php
        }
         ?>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
            <script>
                $(document).ready(function(){
                    $('#roleSelect').change(function(){
                        $('#searchForm').submit();
                    });
                });
            </script>
    </body>

</html>
