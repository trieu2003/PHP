<?php
class LopHoc extends Connect {
    function all(){
        return $this->selectQuery('select * from lophoc');
    }

    function getClass($idClass) {
        $sql = "select * from lophoc where id_lh=?";
        return $this->selectQuery($sql, [$idClass]);
    }
}