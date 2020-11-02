<?php

class Signup{
    private $email;
    private $password;
    private $repassword;
    private $fullname;
    private $age;
    private $id_organization;
    private $admin;
    private $img;
    private $helper;

    public function __construct($email, $password, $repassword, $fullname, $age, $id_organization, $admin, $img, $helper){
        $this->email = $email;
        $this->password = $password;
        $this->repassword = $repassword;
        $this->fullname = $fullname;
        $this->age = $age;
        $this->id_organization = $id_organization;
        $this->admin = $admin;
        $this->img = $img;
        $this->helper = $helper;
    }

    public function signupAction(){
        if($this->password = $this->repassword){
            require_once PATH_SYSTEM . DS . 'helper' . DS . $this->helper . '.php';
            $checkEmail = emailAction($this->email, $conn);
            if($checkEmail){
                $data = array('err', $this->email . ' trùng với một email đã đăng ký');
                return $data;
            }
            $checkId = idAction($this->id_organization, $conn);
            if(!$checkId){
                $data = array('err', $this->id_organization . ' không thuộc tổ chức nào đăng ký với chúng tôi');
                return $data;
            }
            $query = "INSERT INTO users(email, password, fullname, age, id_organization, admin, img) VALUES(?,?,?,?,?,?,?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('sssisis', $v1, $v2, $v3, $v4, $v5, $v6, $v7);

            $v1 = $this->email;
            $v2 = md5($this->password, false);
            $v3 = $this->fullname;
            $v4 = $this->age;
            $v5 = $this->id_organization;
            $v6 = $this->admin;
            $v7 = $this->img;
            
            

            if($stmt->execute()){
                $stmt->close();
                $conn->close();
                $data = array('success', "Đăng ký thành công, hãy chuyển đến trang đăng nhập");
                return $data;
            }
            else{
                $stmt->close();
                $conn->close();
                $data = array('err', "Lỗi. Đăng ký thất bại");

                return $data;
            }
        }

        
        

    }
}

?>