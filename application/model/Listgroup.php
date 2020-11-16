<?php
    class Listgroup{
        private $result = array();
        public function listgroupAction(){
            require_once PATH_SYSTEM . DS . 'helper' . DS . 'listgroup_helper.php';
            
            $query = 'SELECT groups.id AS id, groups.name as name, users.fullname as creator from groups, member, users WHERE member.email = ? AND member.id_group = groups.id AND groups.creator = users.email';
            $stmt = $conn->prepare($query);
            $stmt->bind_param('s', $e);
            $e = $_SESSION['email'];
            
            $stmt->execute();
            include_once PATH_APP . DS . 'model' . DS . 'InfoGroup.php';
            
            $i = 0;
            $stmt->bind_result($idGroup, $nameGroup, $creator);
            while($stmt->fetch()){
                $group = new InfoGroup();
                $group->idGroup =$idGroup;
                $group->nameGroup = $nameGroup;
                $group->creator = $creator;
                array_push($this->result, $group);
            }
            $stmt->close();
            $conn->close();

            return $this->result;
        
           
            
        }
    }
?>