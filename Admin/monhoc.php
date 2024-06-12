<?php
session_start();
if ( isset($_SESSION['id_user'])  && $_SESSION['role'] == 'admin' ) {
  include "../controller/admin_ctl.php";


// Lấy thông tin 
$admin = getAdminInfo($user, $conn);
$monhoc = getAllMonHoc($conn);


?>


<!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>
        Admin  
         
     
    </title>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="../css/style1.css">
      <link rel="icon" href="../imgs/icon.ico">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>
<!-- Thanh menu -->
<?php
            include "navbar.php";
?>

<!-- 
Hiển thị thông tin  -->
    <?php
      if ($monhoc != 0) {
      ?>
       <div class="container mt-5 bg-light">
              
                <a class="btn btn-primary" href="them_mh.php">Thêm môn học</a>
                <?php
                if ($monhoc != 0) {
                ?>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered mt-3  table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Mã môn học</th>
                                    <th scope="col">Tên môn học</th>
                                    <th scope="col">Số tin chỉ</th>
                                    <th scope="col">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($monhoc as $lop) { 
                                    ?>
                                    <tr>
                                        <th scope="row" class="col">
                                            <?php echo $i;
                                            $i++; ?>
                                        </th>
                                        <td scope="row" class="col-2"><?= $lop['id_mh'] ?></td>
                                        <td scope="row" class="col-2"><?= $lop['ten'] ?></td>
                                        <td scope="row" class="col-3"><?= $lop['so_tin_chi'] ?></td>
                                        <td scope="row">
                                            <a href="update_mh.php?id_mh=<?php echo $lop['id_mh'];?>" class="btn btn-warning btn-sm">Sửa</a>
                                        </td>
                                        
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                <?php } ?>

                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
                <script>
                    //$(document).ready(function(){
                    //  $("#navLinks li:nth-child(2) a").addClass('active');
                    //});
                </script>
        </body>

        </html>
<?php

    } else {
        header("Location: ../logout.php");
        exit;
    }
} else {
    header("Location: ../logout.php");
    exit;
}

?>