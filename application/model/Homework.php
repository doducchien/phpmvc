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
    public function editHomework($id, $idGroup, $newName, $newDeadline, $email){
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
            $query = 'UPDATE assignment SET name=? , deadline=? WHERE id=?';
            $stmt = $conn->prepare($query);
            $stmt->bind_param('sss',$newName, $newDeadline, $id);
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
        $query = 'SELECT * FROM member WHERE id_group = ? AND email = ?';
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
    
    public function submitHomework($id, $idHomework, $idGroup, $link, $timeSubmit, $email){

        require_once PATH_SYSTEM  . DS . 'config' . DS . 'config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if(!$conn) die('kết nối thất bại');
        $result = [];
        $query = 'SELECT * FROM member WHERE id_group = ? AND email = ?';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $idGroup, $email);
        $stmt->execute();
        $stmt->store_result();
        $count = $stmt->num_rows();
        if($count == 1){
            $query = 'SELECT * FROM assignment WHERE id_group = ? AND id = ?';
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ss', $idGroup, $idHomework);
            $stmt->execute();
            $stmt->store_result();
            $count = $stmt->num_rows();
            if($count == 1){
                $query = 'INSERT INTO homework VALUES(?, ?, ?, ?, ?)';
                $stmt = $conn->prepare($query);
                $stmt->bind_param('ssssi',$idHomework, $id, $email, $link, $timeSubmit);
                if($stmt->execute()){
                    $stmt->close();
                    $conn->close();
                    return true;
                }
                
            }
            
        }
        $stmt->close();
        $conn->close();
        return false;
        
    } 
    public function getSubmitedHomework($idHomework, $idGroup, $email){
        require_once PATH_SYSTEM  . DS . 'config' . DS . 'config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if(!$conn) die('kết nối thất bại');
        $result = [];
        $query = 'SELECT * FROM member WHERE id_group = ? AND email = ?';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $idGroup, $email);
        $stmt->execute();
        $stmt->store_result();
        $count = $stmt->num_rows();
        if($count == 1){
            $query = 'SELECT * FROM assignment WHERE id_group = ? AND id = ?';
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ss', $idGroup, $idHomework);
            $stmt->execute();
            $stmt->store_result();
            $count = $stmt->num_rows();
            if($count == 1){
                $query = 'SELECT * FROM homework WHERE id_ass = ? AND submiter = ? ORDER BY time DESC';
                $stmt = $conn->prepare($query);
                $stmt->bind_param('ss', $idHomework, $email);
                $stmt->execute();
                $stmt->bind_result($id_ass, $id, $submiter, $link, $time);
                while($stmt->fetch()){
                    $data['id_ass'] = $id_ass;
                    $data['id'] = $id;
                    $data['submiter'] = $submiter;
                    $data['link'] = $link;
                    $data['time'] = $time;
                    array_push($result, $data);
                }
                $stmt->close();
                $conn->close();
                return $result;
                
            }
        }
        $stmt->close();
        $conn->close();
        return false;
    }

     

    public function getSubmiter($idHomework, $idGroup, $email){
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
            $query = 'SELECT * FROM assignment WHERE id = ? AND id_group = ?';
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ss',$idHomework, $idGroup);
            $stmt->execute();
            $stmt->store_result();
            $count = $stmt->num_rows();
            if($count == 1){
                
                $query = 'SELECT * FROM homework WHERE id_ass = ? GROUP BY submiter';
                $stmt = $conn->prepare($query);
                $stmt->bind_param('s', $idHomework);
                $stmt->execute();
                $stmt->bind_result($id_ass, $id, $submiter, $link, $time);
                while($stmt->fetch()){
                    $data['id_ass'] = $id_ass;
                    $data['id'] = $id;
                    $data['submiter'] = $submiter;
                // $data['link'] = $link;
                // $data['time'] = $time;
                    array_push($result, $data);
                }
            $stmt->close();
            $conn->close();
            return $result;
            }

            
        }
        $stmt->close();
        $conn->close();
        return false;
    }
    public function checkSubmited($idHomework, $idGroup, $email, $submiter){
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
            $query = 'SELECT * FROM homework WHERE id_ass = ? AND submiter = ? ORDER BY time DESC';
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ss', $idHomework, $submiter);
            $stmt->execute();
            $stmt->bind_result($id_ass, $id, $submiter, $link, $time);
            while($stmt->fetch()){
                $data['id_ass'] = $id_ass;
                $data['id'] = $id;
                $data['submiter'] = $submiter;
                $data['link'] = $link;
                $data['time'] = $time;
                array_push($result, $data);
            }
            $stmt->close();
            $conn->close();
            return $result;
        }

        $stmt->close();
        $conn->close();
        return false;
    }
    public function saveResult($id, $id_ass, $idGroup, $point, $comment, $author, $email){
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
            $query = 'INSERT INTO result VALUES(?, ?, ?, ?, ?)';
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ssiss', $id, $id_ass, $point, $comment, $author);
            $result = $stmt->execute();
            
            $stmt->close();
            $conn->close();
            return $result;
        }

        $stmt->close();
        $conn->close();
        return false;
    }
    public function getResult($id_ass, $idGroup, $author, $email){
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
            $data=[];
            $query = 'SELECT * FROM result WHERE id_ass = ? AND author = ?';
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ss', $id_ass, $author);
            $stmt->execute();
            $stmt->bind_result($id, $id_ass, $point, $comment, $author);
            if($stmt->fetch()){
                
                $data['id'] = $id;
                $data['id_ass'] = $id_ass;
                $data['point'] = $point;
                $data['comment'] = $comment;
                $data['author'] = $author;
                
            }
            $stmt->close();
            $conn->close();
            return $data;
        }

        $stmt->close();
        $conn->close();
        return false;
    }
    public function deleteHomework($id, $idGroup, $email){
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
            $query1 = 'DELETE FROM result WHERE id_ass = ?';
            $query2 = 'DELETE FROM homework WHERE id_ass = ?';
            $query3 = 'DELETE FROM assignment WHERE id = ?';
            $stmt = $conn->prepare($query1);
            $stmt->bind_param('s', $id);
            $stmt->execute();

            $stmt = $conn->prepare($query2);
            $stmt->bind_param('s', $id);
            $stmt->execute();

            $stmt = $conn->prepare($query3);
            $stmt->bind_param('s', $id);
            $stmt->execute();

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