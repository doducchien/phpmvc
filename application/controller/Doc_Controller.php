<?php

class Doc_Controller extends Controller{
    private $email;
    private $action;

    public function __construct($model, $view, $helper, $action, $email){
        parent:: __construct($model, $view, $helper);
        $this->action = $action;
        $this->email = $email;
    }

    public function createDoc($idGroup, $idDoc, $nameDoc, $linkDoc){
        include_once PATH_APP . DS . 'model' . DS . $this->model . '.php';
            
        $model = $this->model;
        $action = $this->action;

        $modelObj = new $model();
        return $modelObj->{$action}($idGroup, $idDoc, $nameDoc, $linkDoc, $this->email);
    }
}
?>