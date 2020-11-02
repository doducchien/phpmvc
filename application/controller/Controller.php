<?php

class Controller{

    protected $model = NULL;
    protected $view = NULL;
    protected $helper = NULL;

    public function __construct($model, $view, $helper){
        
        
        // include_once PATH_APP . DS . 'model' . DS . $model . '.php';
        $this->model = $model;
        
        // include_once PATH_APP .DS . 'view' . DS . $view . '.php';
        $this->view = $view;

        // include_once PATH_SYSTEM . DS . 'helper' . DS . $helper  . '.php';
        $this->helper = $helper;

    }
}

?>