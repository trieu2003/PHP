<?php

class Connect{
    public static $conn = null;

    function __construct(){
        Connect::$conn = new PDO('mysql:host=' . dbHost . ';dbname=' . dbName, dbUsername, dbPassword); 
    }

    function selectQuery($sql, $params=[]){
        $stm = Connect::$conn->prepare($sql);
        $stm->execute($params);
        return $stm->fetchALL(PDO::FETCH_OBJ); 
    }

    function updateQuery($sql, $params=[]){
        $stm = Connect::$conn->prepare($sql);
        $stm->execute($params);
        return $stm->rowCount(); 
    }
}