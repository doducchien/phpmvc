<?php
class Doc{
    
    public function createDoc($idGroup, $idDoc, $nameDoc, $linkDoc, $email){
        require_once PATH_SYSTEM  . DS . 'config' . DS . 'config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if(!$conn) die('kết nối thất bại');

        return $idGroup;
    }
}
?>