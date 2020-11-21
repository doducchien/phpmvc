<?php 
class ManageGroup_Controller extends Controller{
    private $email;
    private $action;

    public function __construct($model, $view, $helper, $action, $email){
        parent:: __construct($model, $view, $helper);
        $this->action = $action;
        $this->email = $email;
    }

    public function manageGroupAction(){
        include_once PATH_APP . DS . 'model' . DS . $this->model . '.php';
        $model = $this->model;
        $action = $this->action;

        $modelObj = new $model();
        $result = $modelObj->{$action}($this->email);
        return $result;
    }
}

?>