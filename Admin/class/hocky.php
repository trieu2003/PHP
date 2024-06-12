<?php
class hocky extends Db {
    public function all() {
        return $this->selectQuery('SELECT * FROM hocky');
    }

    // public function destroy($id) {
    //     $sql = "SELECT masv FROM sinhvien WHERE malop = ?";
    //     $data1 = $this->selectQuery($sql, [$id]);
    //     if (count($data1) > 0) return -1;

    //     $sql = "DELETE FROM sinhvien WHERE masv = ?";
    //     return $this->updateQuery($sql, [$id]);
    // }

    public function store() {
        $id_hk = $_POST['id_hk'] ?? '';
        $ten = $_POST['ten_hk'] ?? '';
        $nam_hoc = $_POST['Nam_hoc'] ?? '';
    
        $sql = "SELECT * FROM hocky WHERE id_hk = ?";
        $data = $this->selectQuery($sql, [$id_hk]);
        if (count($data) > 0) {
            return -1;
        }
    
        $sql = "INSERT INTO hocky (id_hk, ten_hk, Nam_hoc) VALUES (?, ?, ?)";
        $arr = [$id_hk, $ten, $nam_hoc];
        return $this->updateQuery($sql, $arr);
    }
    
    public function update($masv, $hoten, $email, $malop) {
        $sql = "UPDATE hocky SET ten = ?, Nam_hoc = ?";
        $arr = [ $ten, $nam_hoc];;
        return $this->updateQuery($sql, $arr);
    }

    public function get($id_hk) {
        $sql = "SELECT * FROM hocky WHERE id_hk = ?";
        $data = $this->selectQuery($sql, [$masv]);
        if (count($data) > 0) {
            return $data[0];
        }
        return null;
    }
    // public function search($hoten) {
    //     $sql = "SELECT * FROM sinhvien WHERE hoten LIKE ?";
    //     $params = ["%$hoten%"];
    //     return $this->selectQuery($sql, $params);
    // }
}
?>
