<?php

    require_once PATH_SYSTEM  . DS . 'config' . DS . 'config.php';

    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if(!$conn) die('kết nối thất bại');
    // else echo 'kết nối thành công';


?>