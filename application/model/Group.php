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

}
?>