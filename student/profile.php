<?php
// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION)) session_start();
if (!isset($_SESSION['id_user'])) {
    header("Location: ../login.php");
    exit();
}

$id_user = $_SESSION['id_user'];

    include 'model/configDB.php';
    function loadClass($c){
        include "model/$c.php";
    }
    spl_autoload_register('loadClass');

    $student = new User();
    $data = $student->getUser($id_user);

    $classes = new LopHoc();
    $class = $classes->getClass($data[0]->ma_lop);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cổng thông tin sinh viên</title>

    <!-- Custom fonts for this template-->
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    
    <!-- css for transcript -->
    <link rel="stylesheet" href="css/stu-body.css">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar"></div>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <div id="topbar"></div>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="box-df">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="portlet">
                                    <div class="portlet portlet-body light">
                                        <div>
                                            <img class="avatar img-responsive" src="img/<?php echo $data[0]->hinh_the ?>" alt="" width="160px" height="160px">
                                        </div>
                                        <br />
                                        <div class="form-group">
                                            <div class="control-label text-center"><span lang="thongtinsinhvien-mssv">MSSV</span>: <b><?php echo $data[0]->id_user ?></b></div>
                                        </div>
                                        <div class="form-group">
                                            <div class="control-label text-center"><span lang="thongtinsinhvien-hovaten">Họ tên</span>: <b><?php echo $data[0]->ten ?></b></div>
                                        </div>
                                        <div class="form-group">
                                            <div class="control-label text-center"><span lang="thongtinsinhvien-gioitinh">Giới tính</span>: <b><?php echo $data[0]->gioi_tinh ?></b></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-9">
                                <div class="portlet">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <span class="caption-subject  bold" lang="thongtinsinhvien-thongtinhocvan" style="font-size: 26px">Thông tin học vấn</span>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="col-md-12">
                                            <form class="form-horizontal">
                                                <div class="form-body">
                                                    <div class="form-group">
                                                        <label for="" class="col-xs-6">
                                                            <span>Trạng thái: </span><span class="bold">Đang học</span>
                                                        </label>
                                                        <label for="" class="col-xs-6">
                                                            <span>Mã hồ sơ: </span><span class="bold"><?php echo $data[0]->id_user ?></span>
                                                        </label>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="" class="col-xs-6">
                                                            <span>Lớp học: </span><span class="bold">12DHTH04</span>
                                                        </label>
                                                        <label for="" class="col-xs-6">
                                                            <span>Cơ sở: </span><span class="bold">CNTP TP.HCM</span>
                                                        </label>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="" class="col-xs-6">
                                                            <span>Bậc đại học: </span><span class="bold">Đại học</span>
                                                        </label>
                                                        <label for="" class="col-xs-6">
                                                            <span>Loại hình đào tạo: </span><span class="bold">Chính quy</span>
                                                        </label>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="" class="col-xs-6">
                                                            <span>Khoa: </span><span class="bold">Công nghệ thông tin</span>
                                                        </label>
                                                        <label for="" class="col-xs-6">
                                                            <span>Ngành: </span><span class="bold">Công nghệ thông tin_DH</span>
                                                        </label>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="" class="col-xs-6">
                                                            <span>Chuyên ngành: </span><span class="bold">Công nghệ phần mềm</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <!-- End Heading -->
                </div>
                <!-- End Page Content -->    
            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


    <!-- Include -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            $(function() {
                $("#topbar").load("topbar.php");
            })
    </script>
</body>

</html>