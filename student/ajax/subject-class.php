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

$subCla = new LopHocPhan();

$subClas = $subCla->getClassOfGrade($studenId, $gradeId);
foreach ($subClas as $item) {
    ?>
    <tr>
        <td width="80%">
            <div><?php echo $item->id_lhp?></div>
            <div class="name"><?php echo $item->ten?></div>
        </td>
        <td width="20%">
            <div class="text-center"><?php echo $item->so_tin_chi?></div>
        </td>
    </tr>   
    <?php
}
?>