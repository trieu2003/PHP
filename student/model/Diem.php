<?php
class Diem extends Connect {
    function all(){
        return $this->selectQuery('select * from diem');
    }

    //get marks according to student code
    function getMarks($id) {
        $sql = "select mh.id_mh, ten, tenLop, so_tin_chi, diemTL, diemCK, diemTK, thangDiem4, diemChu, xepLoai 
        from diem d, monhoc mh, lophocphan lhp, lophoc lh 
        where d.id_lhp = lhp.id_lhp and lhp.id_mh = mh.id_mh and lhp.id_lh = lh.id_lh and d.id_sinh_vien='$id'";
        return $this->selectQuery($sql);
    }

    function getMarksOfGrade($id, $grade) {
        $sql = "select mh.id_mh, ten, tenLop, so_tin_chi, diemTL, diemCK, diemTK, thangDiem4, diemChu, xepLoai 
        from diem d, monhoc mh, lophocphan lhp, lophoc lh 
        where d.id_lhp = lhp.id_lhp and lhp.id_mh = mh.id_mh and lhp.id_lh = lh.id_lh and d.id_sinh_vien='$id' and lhp.id_hk = $grade";
        return $this->selectQuery($sql);
    }
}