<?php
class Db {
    public static $conn = null;

    public function __construct() {
        if (self::$conn === null) {
            try {
                self::$conn = new PDO('mysql:host=localhost;dbname=id21952697_quanlydiemsinhvien', 'id21952697_lantrieunam', '123123Trieu$');
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }
    }

    public function selectQuery($sql, $params = []) {
        $stm = self::$conn->prepare($sql);
        $stm->execute($params);
        return $stm->fetchAll();
    }

    public function updateQuery($sql, $params = []) {
        $stm = self::$conn->prepare($sql);
        $stm->execute($params);
        return $stm->rowCount();
    }
}
?>
