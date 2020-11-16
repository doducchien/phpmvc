<?php
if(!isset($_SESSION)) session_start();


define('DS', DIRECTORY_SEPARATOR);
define('PATH_SYSTEM', __DIR__.DS.'system');
define('PATH_APP', __DIR__.DS.'application');

require PATH_SYSTEM.DS.'config'.DS.'config.php';
// main

$controller = NULL;
$model = NULL;
$view = NULL;
$helper = NULL;
$action = NULL;

include_once PATH_APP . DS . 'controller'. DS . 'Controller.php';

if(count($_GET) == 0 && count($_POST) == 0){
    if(isset($_SESSION['email'])){
        header('Location:' . DS . 'phpmvc' . DS . 'application' . DS . 'view' . DS . 'home.php');
        exit;
    }
    header('Location:' . DS . 'phpmvc' . DS . 'application' . DS . 'view' . DS . 'login.php');
    exit;

}
else if(count($_POST) != 0){
    
    if(isset($_POST['signup'])){
        $controller = 'Signup_Controller';
        $action = 'signupAction';
        $helper = 'signup_helper';
        $model = 'Signup';
        
        

        require_once PATH_APP . DS . 'controller' . DS . $controller . '.php';
        $controllerObj = new $controller($model, $view, $helper, $action, $_POST);
        $controllerObj->{$action}();

        
    }
    else if(isset($_POST['login'])){
        $controller = 'Login_Controller';
        $action = 'loginAction';
        $helper = 'login_helper';
        $model = 'Login';

        require PATH_APP . DS . 'controller' . DS . $controller . '.php';
        $controllerObj = new $controller($model, $view, $helper, $action, $_POST);
        $controllerObj->{$action}();

        if(isset($_SESSION['email'])){
            header('Location:' . DS . 'phpmvc' . DS . 'application' . DS . 'view' . DS . 'home.php');
            exit;
        }
        // else header('Location:' . DS . 'phpmvc' . DS . 'application' . DS . 'view' . DS . 'login.php');

        
    }
}
else if(count($_GET) != 0){
    if(isset($_GET['listgroup'])){
        $controller = 'Listgroup_Controller';
        $action = 'listgroupAction';
        $helper = 'listgroup_helper';
        $model = 'Listgroup';

        require PATH_APP . DS . 'controller' . DS . $controller . '.php';
        $controllerObj = new $controller($model, $view, $helper, $action);
        $result = $controllerObj->{$action}();
        echo json_encode($result, JSON_UNESCAPED_UNICODE);

    }
    else if(isset($_GET['idGroup'])){
        $controller = 'Group_Controller';
        $action = 'groupAction';
        $helper = 'group_helper';
        $model = 'Group';

        require PATH_APP . DS . 'controller' . DS . $controller . '.php';
        $controllerObj = new $controller($model, $view, $helper, $action, $_GET['idGroup']);
        // $result = $controllerObj->{$action}();
        $controllerObj->{$action}();
        // echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }
}

?>