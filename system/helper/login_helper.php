<?php
    require_once PATH_SYSTEM . DS . 'helper' . DS .'connectDB.php';

    function loginByCookie($email, $password){
        global $conn;
        $query = "SELECT email FROM users WHERE email = ? AND password = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $e, $p);
        $e = $email;
        $p = $password;
        $stmt->execute();

        $stmt->bind_result($value);
        $stmt->fetch();
        if($value){
            $stmt->close();
            $conn->close();
            return true;
        }
        
        $stmt->close();
        $conn->close();
        return false; 
    }
?>