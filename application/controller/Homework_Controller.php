<?php
class Homework_Controller extends Controller{
    private $action;
    private $email;

    public function __construct($model, $view, $helper, $action, $email){
        parent:: __construct($model, $view, $helper);
        $this->action = $action;
        $this->email = $email;
    }

    public function createHomework($id, $idGroup, $name, $emailAlert, $deadline){
        include_once PATH_APP . DS . 'model' . DS . $this->model . '.php';
            
        $model = $this->model;
        $action = $this->action;

        $modelObj = new $model();
        return $modelObj->{$action}($id, $idGroup, $name, $emailAlert, $deadline, $this->email);

    }

    public function getListHomework($idGroup){
        include_once PATH_APP . DS . 'model' . DS . $this->model . '.php';
            
        $model = $this->model;
        $action = $this->action;

        $modelObj = new $model();
        return $modelObj->{$action}($idGroup, $this->email);
    }
    public function editHomework($id, $idGroup, $newName){
        include_once PATH_APP . DS . 'model' . DS . $this->model . '.php';
            
        $model = $this->model;
        $action = $this->action;

        $modelObj = new $model();
        return $modelObj->{$action}($id,$idGroup, $newName, $this->email);

    }
    public function getDetailHomework($id, $idGroup){
        include_once PATH_APP . DS . 'model' . DS . $this->model . '.php';
            
        $model = $this->model;
        $action = $this->action;

        $modelObj = new $model();
        $result = $modelObj->{$action}($id, $idGroup, $this->email);
        ob_start();
        require PATH_APP . DS . 'view' . DS  . 'homework.php';
        $content = ob_get_contents();
        ob_get_clean();

        echo $content;
    }
}
?>