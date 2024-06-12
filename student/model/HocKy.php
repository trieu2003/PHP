<?php
class HocKy extends Connect {
    function all(){
        return $this->selectQuery('select * from hocky');
    }
}