<?php
    if(!isset($_SESSION)) session_start();

class Login_Controller extends Controller{
    private $data = array();
    private $action;
  
    

    public function __construct($model, $view, $helper, $action, $data){
        parent:: __construct($model, $view, $helper);
        $this->action = $action;
        $this->data = $data;
    }
    public function indexAction(){
        // header('Location:'. DS. 'phpmvc' .DS . 'application' . DS . 'view' . DS . 'login.php');
        
        ob_start();
        require_once PATH_APP .DS . 'view' . DS . $this->view . '.php';
        $contents = ob_get_contents();
        ob_end_clean();

        echo $contents;


        
        
    }
    
    public function loginAction(){
        include_once PATH_APP . DS . 'model' . DS . $this->model .'.php';
        $email = $this->data['email'];
        $password = $this->data['password'];
        
        $model = $this->model;
        $modelObj = new $model($email, $password);
        $result = $modelObj->{$this->action}();

        
        if($result['email']){
            setcookie('email', $email, time() + 2592000);
            setcookie('pass', md5($password), time() + 2592000);
            $_SESSION['email'] = $email;
            return true;
        }
        else{
            
            $err = true;
            ob_start();
            require PATH_APP .DS . 'view' . DS . 'login.php';
            $content = ob_get_contents();
            ob_get_clean();

            echo $content;

        }
        
    }
    
}
?>