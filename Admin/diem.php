<?php
session_start();
if (isset($_SESSION['id_user']) && $_SESSION['role'] == 'admin') {
    include "../controller/admin_ctl.php";
    $searchOption = $_GET['searchOption'] ?? null;
    $id_lhp = $_GET['malophocphan'] ?? null;
    $ma_sv = $_GET['masinhvien'] ?? null;


    $user = $_SESSION['id_user'];
    $admin = getAdminInfo($user, $conn);

    $diem = null;
    if ($id_lhp || $ma_sv) {
        $diem = timKiemDiem($searchOption, $id_lhp, $ma_sv, $conn);
    }
    $danhSachMaLHP = getDanhSachMaLHP($conn);
    
    $diem = timKiemDiem($searchOption, $id_lhp, $ma_sv, $conn);
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Quản lý điểm</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>


<body>
    <!-- Thanh menu -->
    <?php include "navbar.php"; ?>

    <!-- Thanh tìm kiếm -->
    <div class="container search-container">
        <form action="" method="get">
            <fieldset>
                <legend>Tìm kiếm thông tin</legend>
                <div class="row">
                <div class="col-md-4 mb-3">
                <label for="searchOption" class="form-label">Chọn phương thức tìm kiếm:</label>
                <select name="searchOption" id="searchOption" class="form-select">
                <option ></option>
                    <option value="malophocphan" <?php if ($searchOption === 'malophocphan') echo 'selected'; ?>>Theo mã lớp học phần</option>
                    <option value="masinhvien" <?php if ($searchOption === 'masinhvien') echo 'selected'; ?>>Theo mã sinh viên</option>
                </select>
            </div>
                    <div class="col-md-4 mb-3 search-input" id="malophocphanInput" <?php if ($searchOption === 'malophocphan' || $searchOption === 'both') echo 'style="display: block;"'; ?>>
                        <label for="malophocphan" class="form-label">Mã lớp học phần</label>
                        <select name="malophocphan" id="malophocphan" class="form-select">
                            <option value="">-----</option>
                            <?php
                            foreach ($danhSachMaLHP as $maLHP) {
                                $selected = ($id_lhp === $maLHP) ? 'selected' : '';
                                echo "<option value=\"$maLHP\" $selected>$maLHP</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3 search-input" id="masinhvienInput" <?php if ($searchOption === 'masinhvien' || $searchOption === 'both') echo 'style="display: block;"'; ?>>
                        <label for="masinhvien" class="form-label">Mã sinh viên</label>
                        <input type="text" name="masinhvien" id="masinhvien" class="form-control" value="<?php echo isset($_GET['masinhvien']) ? htmlspecialchars($_GET['masinhvien']) : '' ?>">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
            </fieldset>
        </form>
    </div>

    <!-- Hiển thị thông tin -->
    <?php if ($diem) { ?>
        <div class="container mt-5">
            <div class="table-responsive">
                <table class="table  table-bordered  table-hover">
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Mã sinh viên</th>
                            <th scope="col">Họ và tên</th>
                            <th scope="col">Giảng viên</th>
                            <th scope="col">Môn Học</th>
                            <th scope="col">Học Kỳ</th>
                            <th scope="col">Điểm Tiểu Luận</th>
                            <th scope="col">Điểm Cuối Kỳ</th>
                            <th scope="col">Điểm Tổng Kết</th>
                            <th scope="col">Thang điểm 4</th>
                            <th scope="col">Điểm chữ</th>
                            <th scope="col">Xếp loại</th>
                            <th scope="col">Hành động</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($diem as $lop) {
                        ?>
                            <tr>
                                <th scope="row" scope="col-1"><?php echo $i++; ?></th>
                                <td scope="row" scope="col-3"><?= $lop['Mã sinh viên'] ?></td>
                                <td scope="row" scope="col-1"><?= $lop['Họ và tên'] ?></td>
                                <td scope="row" scope="col-4"><?= $lop['Giảng viên'] ?></td>
                                <td scope="row" scope="col-5"><?= $lop['Môn Học'] ?></td>
                                <td scope="row" scope="col-6"><?= $lop['Học Kỳ'] ?></td>
                                <td scope="row" scope="col-7"><?= $lop['Điểm Tiểu Luận'] ?></td>
                                <td scope="row" scope="col-8"><?= $lop['Điểm Cuối Kỳ'] ?></td>
                                <td scope="row" scope="col-9"><?= $lop['Điểm Tổng Kết'] ?></td>
                                <td scope="row" scope="col-10"><?= $lop['Thang điểm 4'] ?></td>
                                <td scope="row" scope="col-11"><?= $lop['Điểm chữ'] ?></td>
                                <td scope="row" scope="col-11"><?= $lop['Xếp loại'] ?></td>
                                <td scope="row" scope="col-12">
                                    <a href="update_diem.php?masinhvien=<?= $lop['Mã sinh viên'] ?>&malophocphan=<?= $id_lhp ?>" class="btn btn-warning btn-sm">Sửa</a>
                                    <!-- <a href="delete_diem.php?malophocphan=<?= $id_lhp ?>&masinhvien=<?= $lop['Mã sinh viên'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa dữ liệu này không?')">Xóa</a> -->
                                </td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php } ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.getElementById("searchOption").addEventListener("change", function() {
        var selectedOption = this.value;

        var malophocphanInput = document.getElementById("malophocphanInput");
        var masinhvienInput = document.getElementById("masinhvienInput");

        if (selectedOption === "malophocphan") {
            malophocphanInput.style.display = "block";
            masinhvienInput.style.display = "none";  
        } else if (selectedOption === "masinhvien") {
            malophocphanInput.style.display = "none";  
            masinhvienInput.style.display = "block";  
        } else if (selectedOption === "both") {
            malophocphanInput.style.display = "block";  
            masinhvienInput.style.display = "block";  
        }
    });
</script>



</body>

</html>

<?php
} else {
    header("Location: ../logout.php");
    exit;
}
?>
