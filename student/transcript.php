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
    
    $student = new Diem();

    $hocky = new HocKy();
    $hkList = $hocky->all();

    $totalNumberOfCredits = 0;
    $gp10 = 0;
    $gp4 = 0;

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
    <link rel="stylesheet" href="css/transcript.css">
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
                    <section class="content-info">
                        <h2 style="font-weight: 800;">Kết quả học tập</h2>
                        <hr>
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12 mb-4">
                                    <table>
                                    <thead class="point-table-head">
                                            <tr>
                                                <th class="text-center" >STT</th>
                                                <th class="text-center" >Mã môn học</th>
                                                <th class="text-center" >Tên môn học/học phần</th>
                                                <th class="text-center" >Lớp dự kiến</th>
                                                <th class="text-center" >Số tín chỉ</th>
                                                <th class="text-center" >TL/BTL</th>
                                                <th class="text-center" >Cuối kỳ</th>
                                                <th class="text-center" >Điểm tổng kết</th>
                                                <th class="text-center" >Thang điểm 4</th>
                                                <th class="text-center" >Điễm chữ</th>						
                                                <th class="text-center" >Xếp loại</th> 
                                            </tr>
                                    </thead>
                                    <tbody class="text-center">
                                            <?php
                                            foreach ($hkList as $item) {
                                                ?>
                                                <tr>
                                                    <td colspan=11 class="text-left row-head"><?php echo $item->ten_hk ?> (<?php echo $item->Nam_hoc ?>)</td>
                                                </tr>
                                                <?php
                                                $data = $student->getMarksOfGrade($id_user, $item->id_hk);
                                                foreach ($data as $key => $value) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $key ?></td>
                                                        <td><?php echo $value->id_mh  ?></td>
                                                        <td class="text-left"><?php echo $value->ten  ?></td>
                                                        <td><?php echo $value->tenLop ?></td>
                                                        <td><?php echo $value->so_tin_chi ?></td>
                                                        <td><?php echo $value->diemTL ?></td>
                                                        <td><?php echo $value->diemCK ?></td>
                                                        <td><?php echo $value->diemTK ?></td>
                                                        <td><?php echo $value->thangDiem4 ?></td>
                                                        <td><?php echo $value->diemChu ?></td>
                                                        <td><?php echo $value->xepLoai ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                                //Tổng điểm CK theo STC theo kỳ
                                                $totalFinalMark = StudyResultsStatistics::caculateGradePoint10($id_user, $item->id_hk);
                                                $gp10 += $totalFinalMark;
                                                //STC theo kỳ 
                                                $numberOfCredits = StudyResultsStatistics::calculateNumberOfCredits($id_user, $item->id_hk);
                                                $totalNumberOfCredits += $numberOfCredits;
                                                //Tổng điểm hệ 4 theo STC theo kỳ
                                                $total4PointScale = StudyResultsStatistics::caculateGradePoint4($id_user, $item->id_hk);
                                                $gp4 += $total4PointScale;
                                                $pointAvager10 = 0;
                                                $pointAvager4 = 0;
                                                if ($numberOfCredits > 0) {
                                                   //Điểm trung bình hệ 10 theo kỳ
                                                    $pointAvager10 = number_format($totalFinalMark / $numberOfCredits, 2);
                                                    //Điểm trung bình hệ 4 theo kỳ
                                                    $pointAvager4 = number_format($total4PointScale / $numberOfCredits, 2);
                                                }
                                                ?>
                                                <tr>
                                                    <td class="text-left" colspan=3>Điểm trung bình học kỳ hệ 10: <?php echo $pointAvager10  ?></td>
                                                    <td class="text-left" colspan=3>Điểm trung bình học kỳ hệ 4: <?php echo $pointAvager4 ?></td>
                                                    <td colspan=5></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                    </tbody>
                                    </table>
                                </div>
                                <div class="col-lg-12">
                                    <table class="text-left">
                                        <thead class="point-table-head">
                                            <tr>
                                                <th colspan=2>Tính theo thực học</th>
                                                <th colspan=2>Tính theo chương trình khung</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Tổng tín chỉ:</td>
                                                <td class="text-center"><?php echo $totalNumberOfCredits?></td>
                                                <td>Tổng tín chỉ:</td>
                                                <td class="text-center"><?php echo $totalNumberOfCredits?></td>
                                            </tr>
                                            <tr>
                                                <?php 
                                                $gpa10 = 0;
                                                $gpa4 = 0;
                                                if ($numberOfCredits > 0) {
                                                     //Điểm trung bình tích luỹ hệ 10 theo kỳ
                                                     $gpa10 = number_format($gp10 / $totalNumberOfCredits, 2);
                                                     //Điểm trung bình tích luỹ hệ 4 theo kỳ
                                                     $gpa4 = number_format($gp4 / $totalNumberOfCredits, 2);
                                                 }
                                                ?>
                                                <td>Trung bình chung tích luỹ: </td>
                                                <td class="text-center"><span><?php echo $gpa10?></span> - <span><?php echo $gpa4 ?></span></td>
                                                <td>Trung bình chung tích luỹ: </td>
                                                <td class="text-center"><span><?php echo $gpa10?></span> - <span><?php echo $gpa4 ?></span></td>
                                            </tr>
                                            <tr>
                                                <td>Xếp loại tốt nghiệp:</td>
                                                <td class="text-center"></td>
                                                <td>Số tín chỉ phải tích luỹ:</td>
                                                <td class="text-center">151</td>
                                            </tr>
                                            <tr>
                                                <td colspan=4>Ghi chú: </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        </section>
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