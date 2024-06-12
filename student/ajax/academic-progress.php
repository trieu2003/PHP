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

$numberOfCredits[] = StudyResultsStatistics::totalNumberOfCredits($studenId);
$numberOfCredits[] = 151;

?>
<script>
    ctx = document.getElementById('doughnut').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
        labels: ['Đã học', 'Tổng'],
        datasets: [{
        label: 'Số tín chỉ',
        data: <?php echo json_encode($numberOfCredits) ?>,
        backgroundColor: [
                'rgba(0, 226, 114)',
                'rgba(44, 175, 254)',
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