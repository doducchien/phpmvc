<?php
class CreateGroup_Controller extends Controller{
    private $action;
    private $email;
    private $data = array();
    public function __construct($model, $view, $helper, $action,$email){
        parent:: __construct($model, $view, $helper);
        $this->action = $action;
        $this->email = $email;
    }

    public function createGroupAction($idGroup, $nameGroup){
        include_once PATH_APP . DS . 'model' . DS . $this->model . '.php';
            
        $model = $this->model;
        $action = $this->action;

        $modelObj = new $model();
        return $modelObj->{$action}($idGroup, $nameGroup, $this->email);

    }
}
?>