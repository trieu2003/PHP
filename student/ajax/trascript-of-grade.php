<?php
if (!isset($_SESSION)) session_start();
if (!isset($_SESSION['id_user'])) {
    header("Location: ../login.php");
    exit();
}

include '../model/configDB.php';
function loadClass($c){
    include "../model/$c.php";
}
spl_autoload_register('loadClass');

$studenId =  $_SESSION['id_user'];
$gradeId = $_GET['gradeId']??'';

$mark = new Diem();
$marks = $mark->getMarksOfGrade($studenId, $gradeId);
foreach ($marks as $item) {
    $subjectMark[] = $item->diemTK;
    $subjectName[] = $item->ten;
}
$subjectMark[] = 10;

?>
<script>
    ctx = document.getElementById('barchart');

    if (chart) {
        chart.destroy();
    }

    chart = new Chart(ctx, {
        type: 'bar',
        data: {
        labels: <?php echo json_encode($subjectName) ?>,
        datasets: [{
        label: 'Điểm của bạn',
        data: <?php echo json_encode($subjectMark) ?>,
        backgroundColor: [
        'rgba(255, 133, 106)',
        ],
        borderWidth: 1
        }]
        },
        options: {
            scales: {
                y: {
                beginAtZero: true
                }
            }
        }                           
    });
</script>