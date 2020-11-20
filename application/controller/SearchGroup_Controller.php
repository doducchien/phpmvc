<?php
class SearchGroup_Controller extends Controller{
    private $action;
    private $searchGroup;

    public function __construct($model, $view, $helper, $action, $searchGroup){
        parent:: __construct($model, $view, $helper);
        $this->action = $action;
        $this->searchGroup = $searchGroup;
    }

    public function searchGroupAction(){
        include_once PATH_APP . DS . 'model' . DS . $this->model . '.php';
        $model = $this->model;
        $action = $this->action;

        $modelObj = new $model();
        $result = $modelObj->{$action}($this->searchGroup);
        return $result;
    }
}
?>