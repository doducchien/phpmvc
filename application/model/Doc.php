<?php
class Doc{
    
    public function createDoc($idGroup, $idDoc, $nameDoc, $linkDoc, $email){
        require_once PATH_SYSTEM  . DS . 'config' . DS . 'config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if(!$conn) die('kết nối thất bại');

        $query1 = "INSERT INTO file VALUES(?, ?, ?, ?, ?)";
        $query2 = "SELECT * FROM member WHERE email=? AND id_group=?";
        $stmt = $conn->prepare($query2);
        $stmt->bind_param('ss', $e, $id_group);
        $e = $email;
        $id_group = $idGroup;

        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows === 1){
            $stmt->close();
            $stmt = $conn->prepare($query1);
            $stmt->bind_param('sssss', $iddoc, $idgroup, $create, $link, $name);
            $iddoc = $idDoc;
            $idgroup=$idGroup;
            $create=$email;
            $link = $linkDoc;
            $name = $nameDoc;

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

    public function getListDoc($idGroup, $email){
        require_once PATH_SYSTEM  . DS . 'config' . DS . 'config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if(!$conn) die('kết nối thất bại');

        $query2 = 'SELECT * from member WHERE email = ? AND id_group=? ';
        $stmt = $conn->prepare($query2);
        $stmt->bind_param('ss', $e, $id);
        $e = $email;
        $id = $idGroup;
        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows === 1){
            $result = [];
            $data = [];
            $query1 = 'SELECT id, name, link, creator FROM file WHERE id_group = ?';
            $stmt->close();
            $stmt = $conn->prepare($query1);
            $stmt->bind_param('s', $id);
            $id = $idGroup;
            $stmt->execute();
            $stmt->bind_result($id, $name, $link, $creator);
            while($stmt->fetch()){
                $data['id'] = $id;
                $data['name'] = $name;
                $data['link'] = $link;
                $data['creator'] = $creator;
                array_push($result, $data);
                $data = [];
            }
            return $result;
        }
        $stmt->close();
        $conn->close();
        return false;
    }
    public function editDoc($id, $newName, $newLink, $email){
        require_once PATH_SYSTEM  . DS . 'config' . DS . 'config.php';

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if(!$conn) die('kết nối thất bại');

        $query = 'UPDATE file SET link=?, name=? WHERE id=? AND creator=?';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssss', $link, $name, $id, $creator);
        $link = $newLink;
        $name = $newName;
        $creator = $email;
        $id = $id;

        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }
}
?>