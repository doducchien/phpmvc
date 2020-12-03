<?php
class Homework{

    public function createHomework($id, $idGroup, $name, $emailAlert, $deadline,$emailCreator){
        require_once PATH_SYSTEM  . DS . 'config' . DS . 'config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if(!$conn) die('kết nối thất bại');

        $query1 = 'SELECT groups.creator FROM groups WHERE id = ?';
        $stmt = $conn->prepare($query1);
        $stmt->bind_param('s', $idg);
        $idg = $idGroup;
        $stmt->execute();
        $stmt->bind_result($creator);
        if($stmt->fetch()){
            if($creator == $emailCreator){
                $query2 = 'INSERT INTO assignment VALUES (?,?,?,?,?)';
                $stmt->prepare($query2);
                $stmt->bind_param('sssss', $id, $idGroup, $deadline, $name, $emailAlert);
                if($stmt->execute()){
                    $stmt->close();
                    $conn->close();
                    return true;
                }
            }
        }
        else{
            $stmt->close();
            $conn->close();
            return false;
        }
    }
    public function getListHomework($idGroup, $email){
        require_once PATH_SYSTEM  . DS . 'config' . DS . 'config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if(!$conn) die('kết nối thất bại');

        $query = 'SELECT * FROM member WHERE id_group=? AND email=?';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $idGroup, $email);
        $stmt->execute();
        $stmt->store_result();
        $count = $stmt->num_rows();
        if($count == 1){
            $result = [];
            $query = 'SELECT * FROM assignment WHERE id_group=? ORDER BY deadline ASC';
            $stmt = $conn->prepare($query);
            $stmt->bind_param('s', $idGroup);
            $stmt->execute();
            $stmt->bind_result($id, $idG, $deadline, $name, $emailAlert);
            while($stmt->fetch()){
                $data['id'] = $id;
                $data['idG'] = $idG;
                $data['deadline'] = $deadline;
                $data['name'] = $name;
                $data['emailAlert'] = $emailAlert;
                array_push($result, $data);
            }
            $stmt->close();
            $conn->close();
            return $result;
        }
        else{
            $stmt->close();
            $conn->close();
            return false;
        }
    }
    public function editHomework($id, $idGroup, $newName, $email){
        require_once PATH_SYSTEM  . DS . 'config' . DS . 'config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if(!$conn) die('kết nối thất bại');

        $query = 'SELECT * FROM groups WHERE id=? AND creator=?';
        $stmt = $conn->prepare($query);

        $stmt->bind_param('ss',$idGroup, $email);
        $stmt->execute();
        $stmt->store_result();

        $count = $stmt->num_rows(); 
        if($count == 1){
            $query = 'UPDATE assignment SET name=? WHERE id=?';
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ss',$newName, $id);
            $result = $stmt->execute();
            $stmt->close();
            $conn->close();
            return $result;

        }
        else{
            $stmt->close();
            $conn->close();
            return false;
        }
        
    }
    public function getDetailHomework($id, $idGroup, $email){
        require_once PATH_SYSTEM  . DS . 'config' . DS . 'config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if(!$conn) die('kết nối thất bại');
        $result = [];
        $query = 'SELECT * FROM groups WHERE id = ? AND creator = ?';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $idGroup, $email);
        $stmt->execute();
        $stmt->store_result();
        $count = $stmt->num_rows();
        if($count == 1){
            $query = 'SELECT groups.id, groups.name, groups.creator, assignment.deadline, assignment.name FROM assignment, groups WHERE assignment.id= ? AND groups.id = ? AND groups.id = assignment.id_group';
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ss', $i, $iG);
            $i = $id;
            $iG = $idGroup;
            $stmt->execute();
            $stmt->bind_result($id_group, $name_group, $creator_group, $deadline, $nameHomework);
            if($stmt->fetch()){
                $data['id_group'] = $id_group;
                $data['name_group'] = $name_group;
                $data['creator_group'] = $creator_group;
                $data['deadline'] = $deadline;
                $data['nameHomework'] = $nameHomework;
                
            }
            $stmt->close();
            $conn->close();
            return $data;
        
        }
        else{
            $stmt->close();
            $conn->close();
            return false;
        }
    }   
}
?>