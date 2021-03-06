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
    public function getListDoc($idGroup){
        include_once PATH_APP . DS . 'model' . DS . $this->model . '.php';
            
        $model = $this->model;
        $action = $this->action;

        $modelObj = new $model();
        return $modelObj->{$action}($idGroup, $this->email);
    }
    
    public function editDoc($id, $newName, $newLink){
        include_once PATH_APP . DS . 'model' . DS . $this->model . '.php';
            
        $model = $this->model;
        $action = $this->action;

        $modelObj = new $model();
        return $modelObj->{$action}($id, $newName, $newLink, $this->email);
    }
    public function deleteDoc($id){
        include_once PATH_APP . DS . 'model' . DS . $this->model . '.php';
            
        $model = $this->model;
        $action = $this->action;

        $modelObj = new $model();
        return $modelObj->{$action}($id);
    }
}


?>