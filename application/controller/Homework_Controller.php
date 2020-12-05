<?php
class Homework_Controller extends Controller{
    private $action;
    private $email;

    public function __construct($model, $view, $helper, $action, $email){
        parent:: __construct($model, $view, $helper);
        $this->action = $action;
        $this->email = $email;
    }

    public function createHomework($id, $idGroup, $name, $emailAlert, $deadline){
        include_once PATH_APP . DS . 'model' . DS . $this->model . '.php';
            
        $model = $this->model;
        $action = $this->action;

        $modelObj = new $model();
        return $modelObj->{$action}($id, $idGroup, $name, $emailAlert, $deadline, $this->email);

    }

    public function getListHomework($idGroup){
        include_once PATH_APP . DS . 'model' . DS . $this->model . '.php';
            
        $model = $this->model;
        $action = $this->action;

        $modelObj = new $model();
        return $modelObj->{$action}($idGroup, $this->email);
    }
    public function editHomework($id, $idGroup, $newName, $newDeadline){
        include_once PATH_APP . DS . 'model' . DS . $this->model . '.php';
            
        $model = $this->model;
        $action = $this->action;

        $modelObj = new $model();
        return $modelObj->{$action}($id,$idGroup, $newName, $newDeadline, $this->email);

    }
    public function getDetailHomework($id, $idGroup, $creator_group){
        include_once PATH_APP . DS . 'model' . DS . $this->model . '.php';

        
            $model = $this->model;
            $action = $this->action;

            $modelObj = new $model();
            $result = $modelObj->{$action}($id, $idGroup, $this->email);
            ob_start();
            if($this->email != $creator_group){
                require PATH_APP . DS . 'view' . DS  . 'homework.php';
            }
            else require PATH_APP . DS . 'view' . DS  . 'listSubmiter.php';
            
            $content = ob_get_contents();
            ob_get_clean();

            echo $content;
        
    }
    

    public function submitHomework($id, $idHomework, $idGroup, $link, $timeSubmit){
        include_once PATH_APP . DS . 'model' . DS . $this->model . '.php';
            
        $model = $this->model;
        $action = $this->action;

        $modelObj = new $model();
        return $modelObj->{$action}($id, $idHomework, $idGroup, $link, $timeSubmit, $this->email);
    }

    public function getSubmitedHomework($idHomework, $idGroup){
        include_once PATH_APP . DS . 'model' . DS . $this->model . '.php';
            
        $model = $this->model;
        $action = $this->action;

        $modelObj = new $model();
        
        return $modelObj->{$action}($idHomework, $idGroup, $this->email);
        
    }

    public function getSubmiter($idHomework, $idGroup){
        include_once PATH_APP . DS . 'model' . DS . $this->model . '.php';
            
        $model = $this->model;
        $action = $this->action;

        $modelObj = new $model();
        
        return $modelObj->{$action}($idHomework, $idGroup, $this->email);
    }
    
    public function checkSubmited($idHomework, $idGroup, $submiter){
        include_once PATH_APP . DS . 'model' . DS . $this->model . '.php';
            
        $model = $this->model;
        $action = $this->action;

        $modelObj = new $model();
        
        return $modelObj->{$action}($idHomework, $idGroup, $this->email, $submiter);
    }
}
?>