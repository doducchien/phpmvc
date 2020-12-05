<?php
    require_once PATH_SYSTEM . DS . 'helper' . DS . 'connectDB.php';
    
    function emailAction($email){
        require_once PATH_SYSTEM  . DS . 'config' . DS . 'config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
        if(!$conn) die('kết nối thất bại');
        $query = 'SELECT email FROM users WHERE email = ?';
        $stmt = $conn->prepare($query);

        $stmt->bind_param('s', $e);
        $e = $email;
        
        $stmt->execute();

        $stmt->bind_result($value);
        $stmt->fetch();

        $stmt->close();
        $conn->close();
        
        return $value;


    }

    function idAction($id){
        require_once PATH_SYSTEM  . DS . 'config' . DS . 'config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if(!$conn) die('kết nối thất bại');
        $query = 'SELECT id FROM organization WHERE id = ?';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $id);
        // $i = $id;

        $stmt->execute();

        $stmt->bind_result($value);
        $stmt->fetch();

        $stmt->close();
        $conn->close();
        return $value;
        
    }
    
    
?>