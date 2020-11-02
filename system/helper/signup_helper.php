<?php
    require_once PATH_SYSTEM . DS . 'helper' . DS . 'connectDB.php';
    
    function emailAction($email, $conn){

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

    function idAction($id, $conn){
        $query = 'SELECT id FROM organization WHERE id = ?';
        $stmt = $conn->prepare($query);

        $stmt->bind_param('s', $i);
        $i = $id;

        $stmt->execute();

        $stmt->bind_result($value);
        $stmt->fetch();

        $stmt->close();
        $conn->close();
        return $value;
        
    }
    
    
?>