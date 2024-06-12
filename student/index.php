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

    $hocky = new HocKy();
    $hkList = $hocky->all();
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

    <!-- * Custom styles for this template--> 
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <link rel="stylesheet" href="css/stu-body.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body id="page-top">
        <!-- <script>
            var chart;
        </script> -->
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

                    <div class="row">
                        <div class="col-lg-6 mb-2">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h3 class="m-0 font-weight-bold">Thông tin sinh viên</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <img class="avatar img-responsive" src="img/<?php echo $data[0]->hinh_the ?>" alt="" style="object-fit: cover;" width="120px" height="120px">
                                        </div>
                                        <div class="col-sm-9">
                                            <form class="form-horizontal">
                                                <div class="form-body">
                                                    <div class="form-group">
                                                        <label for="" class="col-xs-6">
                                                            <span>MSSV: </span><span><?php echo $data[0]->id_user ?></span>
                                                        </label>
                                                        <label for="" class="col-xs-6">
                                                            <span>Lớp: </span><span><?php echo $class[0]->tenLop ?></span>
                                                        </label>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="" class="col-xs-6">
                                                            <span>Họ tên: </span><span><?php echo $data[0]->ten ?></span>
                                                        </label>
                                                        <label for="" class="col-xs-6">
                                                            <span>Giới tính: </span><span><?php echo $data[0]->gioi_tinh ?></span>
                                                        </label>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="" class="col-xs-6">
                                                            <?php  
                                                                $ngay_sinh_str = $data[0]->ngay_sinh;
                                                                $ngay_sinh_obj = DateTime::createFromFormat('Y-m-d', $ngay_sinh_str);
                                                                $ngay_sinh = date_format($ngay_sinh_obj, 'd/m/Y');
                                                            ?>
                                                            <span>Ngày sinh: </span><span><?php echo $ngay_sinh ?></span>
                                                        </label>
                                                        <label for="" class="col-xs-6">
                                                            <span>Khoa: </span><span><?php echo $data[0]->khoa ?></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-2">
                            <div class="row">
                                <div class="col-lg-12 mb-4">
                                    <a href="#" rel="noopener noreferrer">
                                        <div class="card shadow">
                                            <div class="card-body"> 
                                                Nhắc nhở mới, chưa xem <i class="bi bi-bell"></i>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <a href="transcript.php" rel="noopener noreferrer" style="color: #1da1f2">
                                        <div class="card shadow" style="background-color: #e0fbff">
                                            <div class="card-body"> 
                                                Kết quả học tập   <i class="bi bi-graph-up"></i>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-6">
                                    <a href="#" rel="noopener noreferrer" style="color: #ff9205">
                                        <div class="card shadow" style="background-color: #fff2d4">
                                            <div class="card-body"> 
                                                Xem lớp học
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- chart -->
                    <div class="row chart-custom">
                        <div class="col-md-5">
                            <div class="box-df">
                                <div class="portlet">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <span class="caption-subject bold">Kết quả học tập</span>
                                        </div>
                                        <div class="actions">                                            
                                            <select class="form-control" id="cboIDDotThongKeKQHT" langid="db-hocky-combobox" name="cboIDDotThongKeKQHT" placeholder="Chọn học kỳ">
                                            <option value="">Chọn học kỳ</option>
                                            <?php
                                            foreach ($hkList as $item) {
                                                ?>
                                                <option value="<?php echo $item->id_hk?>"><?php echo $item->ten_hk ?> (<?php echo $item->Nam_hoc ?>)</option>
                                                <?php
                                            }
                                            ?>    
                                            </select>
                                        </div>                                   
                                    </div>
                                    <div class="portlet-body">
                                        <div>
                                            <canvas id="barchart" style="display: none;"></canvas>
                                            <img id="img-placeholder" src="img/tkkqht.png" style="display: block;" width=600px>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>   
                        <div class="col-md-3">
                            <div class="box-df">
                                <div class="portlet">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <span class="caption-subject bold" lang="db-tiendohoctap">Tiến độ học tập</span>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div>
                                            <canvas id="doughnut"></canvas>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>                            
                        </div>
                        <div class="col-md-4">
                            <div class="box-df">
                                <div class="portlet">
                                    <div class="portlet-title" style="margin-bottom: 0px;">
                                        <div class="caption">
                                            <span class="caption-subject bold" lang="db-lhp">Lớp học phần</span>
                                        </div>
                                        <div class="actions">                                            
                                            <select class="form-control" id="cbo-subject-class-of-grade" langid="db-hocky-combobox" name="cbo-subject-class-of-grade" placeholder="Chọn học kỳ">
                                            <option value="">Chọn học kỳ</option>
                                            <?php
                                            foreach ($hkList as $item) {
                                                ?>
                                                <option value="<?php echo $item->id_hk?>"><?php echo $item->ten_hk ?> (<?php echo $item->Nam_hoc ?>)</option>
                                                <?php
                                            }
                                            ?>    
                                            </select>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div id="box-dashboard-lophocphan-theodot">
                                            <div class="panel panel-admin">
                                                <div class="panel-heading clearfix">
                                                    <span>M&#244;n học/học phần</span>
                                                    <span class="text-center" style="text-align: right">Số t&#237;n chỉ</span>
                                                </div>
                                                <div class="panel-scroll border-scroll" tabindex="1">
                                                    <table class="table table-striped">
                                                        <tbody id="tbody-subject-class">
                                                                
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        let chart;
                        $(document).ready(function () { 
                            //Kết quả học tập 
                            $('#cboIDDotThongKeKQHT').on('change', function() {
                                const selectedValue = this.value;
                                const chartElement = $('#barchart');
                                const imageElement = $('#img-placeholder');

                                if (selectedValue === '') {
                                chartElement.hide();
                                imageElement.show();
                                } else {
                                    chartElement.show();
                                    imageElement.hide();
                                    $('#barchart').html('');
                                    $.ajax({
                                        url: "ajax/trascript-of-grade.php?gradeId=" + this.value,
                                        type: 'GET',
                                        dataType: 'html',
                                        success: function (data) {
                                            $('#barchart').html(data);
                                        }
                                    });         
                                }                            
                            })

                            //Tiến độ học tập
                            $.ajax({
                                url: 'ajax/academic-progress.php',
                                type: 'GET',
                                dataType: 'html',
                                success: function (data) {
                                $('#doughnut').html(data);
                                }
                            });

                            //lớp học phần
                            $('#cbo-subject-class-of-grade').on('change', function() {
                                const selectedValue = this.value;
                                const tbodyElement = $('#tbody-subject-class');

                                if (selectedValue === '') {
                                    tbodyElement.hide();
                                } else {
                                    tbodyElement.show();
                                    $('#tbody-subject-class').html('');
                                    $.ajax({
                                        url: "ajax/subject-class.php?gradeId=" + this.value,
                                        type: 'GET',
                                        dataType: 'html',
                                        success: function (data) {
                                            $('#tbody-subject-class').html(data);
                                        }
                                    });         
                                }                            
                            })
                        })
                    </script>
                    <!-- End-chart -->
                </div>
                <!-- End Page Content -->    
            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

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