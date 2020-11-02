<?php
class Login{
    
    private $email;
    private $password;

    public function __construct($email, $password){
        $this->email = $email;
        $this->password = $password;
    }

    public function loginAction(){
        require_once PATH_SYSTEM . DS . 'helper' . DS . 'login_helper.php';

        $query = 'SELECT email, fullname FROM users WHERE email=? AND password = ?';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss',$e, $p);
        $e = $this->email;
        $p = md5($this->password);
        $stmt->execute();

        $stmt->bind_result($emailValue, $fullnameValue);
      
        $stmt->fetch();

        return array('email'=>$emailValue,'fullname'=>$fullnameValue);

        
    }

    
}
?>