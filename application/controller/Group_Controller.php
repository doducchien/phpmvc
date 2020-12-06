<?php
class Group_Controller extends Controller{
    private $action;
    private $idGroup;

    public function __construct($model, $view, $helper, $action, $idGroup){
        parent:: __construct($model, $view, $helper);
        $this->action = $action;
        $this->idGroup = $idGroup;
    }

    public function groupAction(){
        include_once PATH_APP . DS . 'model' . DS . $this->model . '.php';
        $model = $this->model;
        $action = $this->action;

        $modelObj = new $model();
        $result = $modelObj->{$action}($this->idGroup);
        ob_start();
        require PATH_APP . DS . 'view' . DS . 'group.php';
        $content = ob_get_contents();
        ob_get_clean();

        echo $content;
        // var_dump($result);
    }

    public function deleteMemmber($memmber, $idGroup, $email){
        include_once PATH_APP . DS . 'model' . DS . $this->model . '.php';
            
        $model = $this->model;
        $action = $this->action;

        $modelObj = new $model();
        
        return $modelObj->{$action}($memmber, $idGroup, $email);
    }
    public function leaveGroup($idGroup, $email){
        include_once PATH_APP . DS . 'model' . DS . $this->model . '.php';
            
        $model = $this->model;
        $action = $this->action;

        $modelObj = new $model();
        
        return $modelObj->{$action}($idGroup, $email);
    }
    public function joinGroup($idGroup, $email){
        include_once PATH_APP . DS . 'model' . DS . $this->model . '.php';
            
        $model = $this->model;
        $action = $this->action;

        $modelObj = new $model();
        
        return $modelObj->{$action}($idGroup, $email);
    }
}
?>