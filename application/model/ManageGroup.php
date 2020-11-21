<?php
class ManageGroup{
    private $result = [];
    public function manageGroupAction($email){
        $data = [];
        require_once PATH_SYSTEM . DS . 'helper' .DS . 'manageGroup_helper.php';
        $query = 'SELECT groups.id, groups.name, id_total.total FROM (SELECT id_group, COUNT(id_group) as total FROM member GROUP BY id_group) as id_total, groups WHERE id_total.id_group = groups.id AND groups.creator = ?';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $e);
        $e = $email;

        $stmt->execute();

        $stmt->bind_result($id, $name, $total);
        while($stmt->fetch()){
            $data['id'] = $id;
            $data['nameGroup'] = $name;
            $data['totalMember'] = $total;

            array_push($this->result, $data);
            $data = [];
        }
        $stmt->close();
        $conn->close();
        return $this->result;
    }
}
?>