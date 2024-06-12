<?php
class User extends Connect {
    function all(){
        return $this->selectQuery('select * from category');
    }

    function getUser($id) {
        $sql = "select * from users where id_user=?";
        return $this->selectQuery($sql, [$id]);
    }
}