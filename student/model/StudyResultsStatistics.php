<?php

class StudyResultsStatistics {

    private static $conn = null;

    private static function connect() {
        self::$conn = new PDO('mysql:host=' . dbHost . ';dbname=' . dbName, dbUsername, dbPassword);
    }

    private static function selectQuery($sql, $params=[]){
        self::connect();
        $stm = self::$conn->prepare($sql);
        $stm->execute($params);
        return $stm->fetchALL(PDO::FETCH_OBJ); 
    }

    private function updateQuery($sql, $params=[]){
        $stm = self::$conn->prepare($sql);
        $stm->execute($params);
        return $stm->rowCount(); 
    }

    //Tổng điểm CK theo STC theo kỳ
    static function caculateGradePoint10($stuID, $gradeId){
        $query = "select diemTK, so_tin_chi 
                from diem d, lophocphan lhp, monhoc mh 
                where d.id_lhp = lhp.id_lhp and lhp.id_mh = mh.id_mh and id_sinh_vien=? and id_hk = ?";
        $finalMarkList = self::selectQuery($query, [$stuID, $gradeId]);
        $overallFinalMask = 0;
        foreach ($finalMarkList as $mark) {
            $overallFinalMask += $mark->diemTK * $mark->so_tin_chi;
        }
        return $overallFinalMask;
    }

    //Tổng điểm hệ 4 theo STC theo kỳ
    static function caculateGradePoint4($stuID, $gradeId){
        $query = "select thangDiem4, so_tin_chi 
                from diem d, lophocphan lhp, monhoc mh 
                where d.id_lhp = lhp.id_lhp and lhp.id_mh = mh.id_mh and id_sinh_vien=? and id_hk = ?";
        $fourPointScaleList = self::selectQuery($query, [$stuID, $gradeId]);
        $overall4PointScale = 0;
        foreach ($fourPointScaleList as $mark) {
            $overall4PointScale += $mark->thangDiem4 * $mark->so_tin_chi;
        }
        return $overall4PointScale;
    }

    //Tổng STC
    static function totalNumberOfCredits($stuID){
        $query = "select so_tin_chi 
                from diem d, lophocphan lhp, monhoc mh 
                where d.id_lhp = lhp.id_lhp and lhp.id_mh = mh.id_mh and id_sinh_vien=?";
        $numberOfCreditsList = self::selectQuery($query, [$stuID]);
        $totalNumberOfCredits = 0;
        foreach ($numberOfCreditsList as $numberOfCredits) {
            $totalNumberOfCredits += $numberOfCredits->so_tin_chi;
        }
        return $totalNumberOfCredits;
    }   

    //Tổng STC theo kỳ
    static function calculateNumberOfCredits($stuID, $gradeId){
        $query = "select so_tin_chi 
                from diem d, lophocphan lhp, monhoc mh 
                where d.id_lhp = lhp.id_lhp and lhp.id_mh = mh.id_mh and id_sinh_vien=? and id_hk = ?";
        $numberOfCreditsList = self::selectQuery($query, [$stuID, $gradeId]);
        $totalNumberOfCredits = 0;
        foreach ($numberOfCreditsList as $numberOfCredits) {
            $totalNumberOfCredits += $numberOfCredits->so_tin_chi;
        }
        return $totalNumberOfCredits;
    }
}
?>