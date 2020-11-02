<?php

class Signup_Controller extends Controller{

    private $action;

    private $data = array();

    public function __construct($model, $view, $helper, $action, $data){
        parent:: __construct($model, $view, $helper);
        $this->action = $action;
        $this->data = $data;
    }

    public function  signupAction(){
        include_once PATH_APP . DS . 'model' . DS . $this->model . '.php';
       
        $email = $this->data['email'];
        $password = $this->data['password'];
        $repassword = $this->data['repassword'];
        $fullName = $this->data['fullname'];
        $age = $this->data['age'];
        $id_organization = $this->data['id_organization'];
        $admin = 0;
        $img = '';
        $helper = $this->helper;

        $model = $this->model;
        
        $modelObj = new $model($email, $password, $repassword, $fullName, $age, $id_organization, $admin, $img, $helper);
        $result = $modelObj->{$this->action}();
        
        

        ob_start();
        require PATH_APP .DS . 'view' . DS . 'signup.php';
        $content = ob_get_contents();
        ob_get_clean();
        
        echo $content;
        

    }
}


?>