<?php
    class Listgroup_Controller extends Controller{
        private $ation;
        private $data = array();
        public function __construct($model, $view, $helper, $action){
            parent:: __construct($model, $view, $helper);
            $this->action = $action;
        }

        public function listgroupAction(){
            include_once PATH_APP . DS . 'model' . DS . $this->model . '.php';
            
            $model = $this->model;
            $action = $this->action;

            $modelObj = new $model();
            return $modelObj->{$action}();

        }
    }
?>