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
    else if(isset($_POST['confirm'])){
        $controller = 'Account_Controller';
        $action = 'updateAccountAction';
        $helper = 'account_helper';
        $model = 'Account';
        require PATH_APP . DS . 'controller' . DS . $controller . '.php';
        $controllerObj = new $controller($model, $view, $helper, $action, $_POST['email']);
        $result = $controllerObj->{$action}($_POST['email'], $_POST['fullname'],intval($_POST['age']));
        if($result){
            header('Location:' . DS . 'phpmvc' . DS . 'index.php?=account=' . DS . $_POST['email']);
        }
        else{
            echo 'NONONo';
        }
    }
    else if(isset($_POST['createGroup'])){
        $controller = 'CreateGroup_Controller';
        $action = 'createGroupAction';
        $helper = 'group_help';
        $model = 'Group';

        require PATH_APP . DS . 'controller' . DS . $controller . '.php';
        $controllerObj = new $controller($model, $view, $helper, $action, $_SESSION['email']);
        $result = $controllerObj->{$action}($_POST['idGroupCreate'], $_POST['nameGroup']);
        echo json_encode($result, JSON_UNESCAPED_UNICODE);

    }
    else if(isset($_POST['renameGroup'])){
        $controller = 'RenameGroup_Controller';
        $action = 'renameGroupAction';
        $helper = 'group_help';
        $model = 'Group';

        require PATH_APP . DS . 'controller' . DS . $controller . '.php';
        $controllerObj = new $controller($model, $view, $helper, $action, $_SESSION['email']);
        $result = $controllerObj->{$action}($_POST['idGroup'], $_POST['rename']);
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }
    else if(isset($_POST['createDoc'])){
        $controller = 'Doc_Controller';
        $action = 'createDoc';
        $helper = 'doc_helper';
        $model = 'Doc';
        require PATH_APP . DS . 'controller' . DS . $controller . '.php';
        $controllerObj = new $controller($model, $view, $helper, $action, $_SESSION['email']);
        $result = $controllerObj->{$action}($_POST['idGroup'], $_POST['idDoc'], $_POST['nameDoc'], $_POST['linkDoc']);
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }
    else if(isset($_POST['getListDoc'])){
        $controller = 'Doc_Controller';
        $action = 'getListDoc';
        $helper = 'doc_helper';
        $model = 'Doc';
        require PATH_APP . DS . 'controller' . DS . $controller . '.php';
        $controllerObj = new $controller($model, $view, $helper, $action, $_SESSION['email']);
        $result = $controllerObj->{$action}($_POST['idGroup']);
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }
    else if(isset($_POST['editDoc'])){
        $controller = 'Doc_Controller';
        $action = 'editDoc';
        $helper = 'doc_helper';
        $model = 'Doc';
        require PATH_APP . DS . 'controller' . DS . $controller . '.php';
        $controllerObj = new $controller($model, $view, $helper, $action, $_SESSION['email']);
        $result = $controllerObj->{$action}($_POST['idDoc'], $_POST['newName'], $_POST['newLink']);
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }
    else if(isset($_POST['deleteDoc'])){
        $controller = 'Doc_Controller';
        $action = 'deleteDoc';
        $helper = 'doc_helper';
        $model = 'Doc';
        require PATH_APP . DS . 'controller' . DS . $controller . '.php';
        $controllerObj = new $controller($model, $view, $helper, $action, $_SESSION['email']);
        $result = $controllerObj->{$action}($_POST['idDoc']);
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
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
    else if(isset($_GET['searchGroup'])){
        $controller = 'SearchGroup_Controller';
        $action = 'searchGroupAction';
        $helper = 'searchGroup_helper';
        $model = 'SearchGroup';
        require PATH_APP . DS . 'controller' . DS . $controller . '.php';
        $controllerObj = new $controller($model, $view, $helper, $action, $_GET['searchGroup']);
        $result = $controllerObj->{$action}();
        echo json_encode($result, JSON_UNESCAPED_UNICODE);

    }
    else if(isset($_GET['account'])){
        $controller = 'Account_Controller';
        $action = 'accountAction';
        $helper = 'account_helper';
        $model = 'Account';
        require PATH_APP . DS . 'controller' . DS . $controller . '.php';
        $controllerObj = new $controller($model, $view, $helper, $action, $_GET['account']);
        $result = $controllerObj->{$action}();

        
    }
    else if(isset($_GET['logout'])){
        unset($_SESSION['email']);
        setcookie("email", "",time() -10000000);
        setcookie("pass", "", time() -10000000);
        header('Location:' . DS . 'phpmvc' . DS . 'index.php');

    }
    else if(isset($_GET['manage-group'])){
        $email = $_GET['manage-group'];

        $controller = 'ManageGroup_Controller';
        $action = 'manageGroupAction';
        $helper = 'manageGroup_helper';
        $model = 'ManageGroup';
        
        require PATH_APP . DS . 'controller' . DS . $controller . '.php';
        $controllerObj = new $controller($model, $view, $helper, $action, $email);
        $result = $controllerObj->{$action}();
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }
}

?>