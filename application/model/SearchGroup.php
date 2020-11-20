<?php
class SearchGroup{
    private $data=[];

    public function searchGroupAction($searchGroup){
        // require_once PATH_SYSTEM . DS . 'helper' . DS . 'searchGroup.php';
        include_once PATH_APP . DS . 'model' . DS . 'Group.php';
        
        $group = new Group($searchGroup);
        $result = $group->groupAction($searchGroup);
        $email = $group->isJoin($searchGroup);
        array_push($this->data, $result[0]);
        array_push($this->data, count(isset($result[1]['listMember'][0])? $result[1]['listMember']: [] ));
        array_push($this->data, $email);
     
        return $this->data;
    }
}
?>