<?php
class LopHocPhan extends Connect {
    function all(){
        return $this->selectQuery('select * from lophocphan');
    }

    function getClassOfGrade($stuId, $graId) {
        $sql = "select lhp.id_lhp, mh.ten, mh.so_tin_chi 
        from diem d, lophocphan lhp, monhoc mh
        where d.id_lhp = lhp.id_lhp and lhp.id_mh = mh.id_mh 
        and d.id_sinh_vien='$stuId' and lhp.id_hk=$graId";
        return $this->selectQuery($sql);
    }
}