<?php
    class InfoGroup{
        public $idGroup;
        public $nameGroup;
        public $creator;

        

        // public function groupAction($idGroup){
        //     $result = [];
        //     require_once PATH_SYSTEM . DS . 'helper' . DS . 'group_helper.php';
        //     $query = 'SELECT * FROM groups WHERE id = ?';
        //     $stmt = $conn->prepare($query);
        //     $stmt->bind_param('s', $id);
        //     $id = $this->$idGroup;

        //     $stmt->execute();
        //     $stmt->bind_result($idGroup, $nameGroup, $creator);
            
        //     array_push('idGroup'=>$idGroup)
        //     array_push('nameGroup'=>$nameGroup)
        //     array_push('creator'=>$creator)
        //     return $result;

        // }
    }
?>