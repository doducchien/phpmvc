<?php
class Account_Controller extends Controller{
    private $action;
    private $email;

    public function __construct($model, $view, $helper, $action, $email){
        parent:: __construct($model, $view, $helper);
        $this->action = $action;
        $this->email = $email;
    }

    public function accountAction(){
        include_once PATH_APP . DS . 'model' . DS . $this->model . '.php';

        $model = $this->model;
        $action = $this->action;

        $modelObj = new $model();
        $result = $modelObj->{$action}($this->email);

        ob_start();
        require PATH_APP . DS . 'view' . DS . 'account.php';
        $content = ob_get_contents();
        ob_get_clean();

        echo $content;
        // var_dump($result);
    }
    public function updateAccountAction($email, $fullname, $age){
        include_once PATH_APP . DS . 'model' . DS . $this->model . '.php';
        $model = $this->model;
        $action = $this->action;

        $modelObj = new $model();
        $result = $modelObj->{$action}($email, $fullname, $age);
        return $result;
    }
    public function getInfoMember($email){
        include_once PATH_APP . DS . 'model' . DS . $this->model . '.php';
        $model = $this->model;
        $action = 'accountAction';

        $modelObj = new $model();
        $result = $modelObj->{$action}($email);
        return $result;
    }
}
?>