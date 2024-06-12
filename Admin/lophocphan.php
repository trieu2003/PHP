<?php
session_start();
if (isset($_SESSION['id_user']) && $_SESSION['role'] == 'admin') {
    include "../controller/admin_ctl.php";

    $admin = getAdminInfo($user, $conn);


    $lopHocPhanList = getLopHocPhanList($conn);


    $selectedLopHocPhan = isset($_GET['lop_hoc_phan']) ? $_GET['lop_hoc_phan'] : '';
    $lophocphan = getLopHocPhan($conn, $selectedLopHocPhan);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style1.css">
    <link rel="icon" href="../imgs/icon.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <!-- Thanh menu -->
    <?php include "navbar.php"; ?>

    <!-- Hiển thị thông tin -->
    <div class="container mt-5 bg-light">
        <center><h2>Danh sách lớp học phần</h2></center> 
        <!-- Thanh tìm kiếm  -->
        <form action="" method="get">
            <fieldset>
                <label for="lop_hoc_phan">Mã lớp học phần:</label>
                <select name="lop_hoc_phan" id="lop_hoc_phan">
                    <option value="">-----</option>
                    <?php foreach ($lopHocPhanList as $lop) { ?>
                        <option value="<?= $lop['id_lhp']; ?>" <?= $selectedLopHocPhan == $lop['id_lhp'] ? 'selected' : '' ?>><?= $lop['id_lhp']; ?></option>
                    <?php } ?>
                </select>
                <input type="submit" value="Tìm kiếm">
            </fieldset>
        </form>  
        <a class="btn btn-primary" href="them_lhp.php">Thêm lớp học</a>
        <?php if (!empty($lophocphan)) { ?>
        <div class="table-responsive">
            <table class="table table-sm table-bordered mt-3 table-hover">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Mã lớp học phần</th>
                        <th scope="col">Tên lớp học</th>
                        <th scope="col">Tên môn học</th>
                        <th scope="col">Tên giảng viên</th>
                        <th scope="col">Tên Học kỳ</th>
                        <th scope="col">Sĩ số</th>
                         <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($lophocphan as $lop) {
                    ?>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $lop['id_lhp']; ?></td>
                        <td><?= $lop['ten_lop']; ?></td>
                        <td><?= $lop['ten_monhoc']; ?></td>
                        <td><?= $lop['ten_giangvien']; ?></td>
                        <td><?= $lop['ten_hk']; ?></td>
                        <td><?= $lop['si_so']; ?></td>
                         <td><a href="motlophocphan.php?id_lhp=<?= $lop['id_lhp']; ?>">Đến lớp</a></td> 
                    </tr>
                    <?php $i++; } ?>
                </tbody>
            </table>
        </div>
        <?php } ?>
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
