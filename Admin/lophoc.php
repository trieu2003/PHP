<?php
session_start();
if ( isset($_SESSION['id_user'])  && $_SESSION['role'] == 'admin' ) {
  include "../controller/admin_ctl.php";


// Lấy thông tin 
$admin = getAdminInfo($user, $conn);
$lophoc = getLopHoc($conn);


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
      if ($lophoc != 0) {
      ?>
       <div class="container mt-5 bg-light">
              
                <a class="btn btn-primary" href="them_lh.php">Thêm lớp học</a>
                <?php
                if ($lophoc != 0) {
                ?>
                    <div class="table-responsive">
                        <table class="table table-bordered mt-3  table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Mã lớp học</th>
                                    <th scope="col">Tên lớp học</th>
                                    <th scope="col">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($lophoc as $lop) { 
                                    ?>
                                    <tr>
                                        <th scope="row" class="col-2">
                                            <?php echo $i;
                                            $i++; ?>
                                        </th>
                                        <td scope="row" class="col-2"><?= $lop['id_lh'] ?></td>
                                        <td scope="row" class="col-2"><?= $lop['tenLop'] ?></td>
                                        <td scope="row" class="col-2">
                                        <a href="update_lh.php?id_lh=<?php echo $lop['id_lh'];?>" class="btn btn-warning btn-sm">Sửa</a>
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