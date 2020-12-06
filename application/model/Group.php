<?php
class Group{
    private $idGroup;
    private $nameGroup;
    private $creator;
    private $listMember = [];

    public function groupAction($idG){
            $result = [];
            require_once PATH_SYSTEM . DS . 'helper' . DS . 'group_helper.php';
            $query = 'SELECT gr.id, gr.name, gr.creator, u.fullname FROM groups AS gr, users AS u WHERE gr.id = ? AND gr.creator = u.email';
            $query1 = 'SELECT email FROM member WHERE id_group = ?';
            $stmt = $conn->prepare($query);
            $stmt->bind_param('s', $id);
            $id = $idG;
            $stmt->execute();
            $stmt->bind_result($idGroup, $nameGroup, $creator, $fullname);
            if($stmt->fetch()){
                
                array_push($result, ["idGroup" => $idGroup, "nameGroup"=>$nameGroup, "creator"=>$creator, "fullname"=>$fullname]);

            }
            $stmt->close();

            $stmt = $conn->prepare($query1);
            $stmt->bind_param('s', $id);
            $id = $idG;
            $stmt->execute();
            $stmt->bind_result($email);
            while($stmt->fetch()){
                array_push($this->listMember, $email);
                
            }
            array_push($result, ['listMember'=>$this->listMember]);
            $stmt->close();
            $conn->close();
            
            return $result;

        }
    public function isJoin($idG){
        require_once PATH_SYSTEM  . DS . 'config' . DS . 'config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if(!$conn) die('kết nối thất bại');

        $query = 'SELECT * FROM member WHERE email = ? AND id_group = ?';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $e, $idGroup);
        $e = $_SESSION['email'];
        $idGroup = $idG;
        $stmt->execute();
        $stmt->bind_result($email, $id_group);
        $stmt->fetch();
        $stmt->close();
        $conn->close();
        return $email;
        
    }

    public function createGroupAction($idGroup, $nameGroup, $email){
        require_once PATH_SYSTEM  . DS . 'config' . DS . 'config.php';
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if(!$conn) die('kết nối thất bại');

        $query = 'INSERT INTO groups VALUES (?,?,?)';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sss', $id, $name, $email);
        $id = $idGroup;
        $name = $nameGroup;
        $email = $email;

        if($stmt->execute()){
            $query = 'INSERT INTO member VALUES (?, ?)';
            $stmt1 = $conn->prepare($query);
            $stmt1->bind_param('ss', $e, $id);
            $e = $email;
            $id = $idGroup;
            $stmt1->execute();
            $stmt1->close();
            $conn->close();
            return true;
        }
        else{
            $stmt->close();
            $conn->close();
            
            return false;
        } 

        
    }
    public function renameGroupAction($id, $rename, $email){
        require_once PATH_SYSTEM  . DS . 'config' . DS . 'config.php';
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if(!$conn) die('kết nối thất bại');

        $query = 'UPDATE groups SET name=? WHERE id=? AND creator=?';
        $stmt = $conn->prepare($query);

        $stmt->bind_param('sss', $rename, $idgroup, $creator);
        $rename = $rename;
        $idgroup = $id;
        $creator = $email;
        $result = $stmt->execute();
        return $result;

    }

    public function deleteMemmber($memmber, $idGroup, $email){
        require_once PATH_SYSTEM  . DS . 'config' . DS . 'config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if(!$conn) die('kết nối thất bại');
        $query = 'SELECT * FROM groups WHERE id = ? AND creator = ?';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $idGroup, $email);
        $stmt->execute();
        $stmt->store_result();
        $count = $stmt->num_rows();
        if($count == 1){
            $query1 = 'DELETE FROM result WHERE author = ?';
            $query2 = 'DELETE FROM homework WHERE submiter = ?';
            $query3 = 'DELETE FROM member WHERE email = ? AND id_group =? ';
            $stmt = $conn->prepare($query1);
            $stmt->bind_param('s', $memmber);
            $stmt->execute();

            $stmt = $conn->prepare($query2);
            $stmt->bind_param('s', $memmber);
            $stmt->execute();

            $stmt = $conn->prepare($query3);
            $stmt->bind_param('ss', $memmber, $idGroup);
            $stmt->execute();

            $stmt->close();
            $conn->close();
            return true;
        }
        $stmt->close();
        $conn->close();
        return false;
    }
    public function leaveGroup($idGroup, $email){
        require_once PATH_SYSTEM  . DS . 'config' . DS . 'config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if(!$conn) die('kết nối thất bại');
        $query = 'SELECT * FROM member WHERE id_group = ? AND email = ?';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $idGroup, $email);
        $stmt->execute();
        $stmt->store_result();
        $count = $stmt->num_rows();
        if($count == 1){
            $query1 = 'DELETE FROM result WHERE author = ?';
            $query2 = 'DELETE FROM homework WHERE submiter = ?';
            $query3 = 'DELETE FROM member WHERE email = ? AND id_group =? ';
            $stmt = $conn->prepare($query1);
            $stmt->bind_param('s', $email);
            $stmt->execute();

            $stmt = $conn->prepare($query2);
            $stmt->bind_param('s', $email);
            $stmt->execute();

            $stmt = $conn->prepare($query3);
            $stmt->bind_param('ss', $email, $idGroup);
            $stmt->execute();

            $stmt->close();
            $conn->close();
            return true;
        }
        $stmt->close();
        $conn->close();
        return false;
    }
    public function joinGroup($idGroup, $email){
        require_once PATH_SYSTEM  . DS . 'config' . DS . 'config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if(!$conn) die('kết nối thất bại');
        $query = 'INSERT INTO member VALUES(?, ?)';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $email, $idGroup);
        $result = $stmt->execute();
        
        $stmt->close();
        $conn->close();
        return $result;
    }
}
?>