<?php
class Account{
    private $result = [];

    public function accountAction($email){
        require_once PATH_SYSTEM . DS . 'helper' . DS . 'account_helper.php';
        $query = 'SELECT u.email, u.fullname, u.age, o.id, o.name as name_organization, o.img as or_img from users as u, organization as o WHERE u.email = ? AND u.id_organization  = o.id';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $e);
        $e = $email;
        $stmt->execute();
        $stmt->bind_result($email, $fullname, $age, $id_organization, $name_organization, $img_organization);
        if($stmt->fetch()){
            // array_push($this->result, array('email' => $email));
            // array_push($this->result, array('fullname'=>$fullname));
            // array_push($this->result, array('age'=>$age));
            // array_push($this->result, array('id_organization'=>$id_organization));
            // array_push($this->result, array('name_organization'=>$name_organization));
            $this->result['email'] = $email;
            $this->result['fullname'] = $fullname;
            $this->result['age'] = $age;
            $this->result['id_organization'] = $id_organization;
            $this->result['name_organization'] = $name_organization;
            $this->result['img_organization'] = $img_organization;

        }
        return $this->result;
    }
    public function updateAccountAction($email, $fullname, $age){
                    
        require_once PATH_SYSTEM . DS . 'helper' . DS . 'account_helper.php';
        $query = 'UPDATE users SET fullname = ?,age= ? WHERE email = ?';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sis', $fn, $a, $e);
        $fn = $fullname;
        $a = $age;
        $e = $email;
        if($stmt->execute()){
            $stmt->close();
            $conn->close();
            return true;
        }
        $stmt->close();
        $conn->close();
        return false;
        
    }

    
}
?>