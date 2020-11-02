<?php
    if(!isset($_SESSION)) session_start();
    if(!defined('DS')){
        define('DS', DIRECTORY_SEPARATOR);
        define('PATH_SYSTEM', __DIR__.DS. '..' . DS . '..' . DS . DS . 'system');
        define('PATH_APP', __DIR__.DS.'application');
    }

    
    if(isset($_SESSION['email'])){
        if(isset($_COOKIE['email'])){
            if($_COOKIE['email'] == $_SESSION['email']){
                header('Location:' . DS . 'phpmvc' .DS . 'application' . DS . 'view' . DS . 'home.php');
                exit;
            }
        }
    }
    else{
        if(isset($_COOKIE['email']) && isset($_COOKIE['pass'])){
            require_once PATH_SYSTEM . DS . 'helper' . DS . 'login_helper.php';
            
            $isLogin = loginByCookie($_COOKIE['email'], $_COOKIE['pass']);
            if($isLogin){
                echo 'hihi';
                $_SESSION['email'] = $_COOKIE['email'];
                header('Location:' . DS . 'phpmvc' . DS . 'application' . DS . 'view' . DS . 'home.php');
                exit;
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <base href="http://localhost/phpmvc/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="public/css/init.css" type="text/css">
    <link rel="stylesheet" href="public/css/login.css" type="text/css">
   
    
    
</head>
<body>
    
    <div class='login'>
        <?php
            if(isset($err)){
                if($err){
                    print "<div class='err-login'>Sai email hoặc mật khẩu</div>";
                }
                
            }
        ?>
        <div class="frame-login">
            <img src="public/assets/img/login/bklogo.png" alt="BKHN">
            <form action="index.php" method='POST'>
                <input required type="email" placeholder='Nhập email...' name='email'>
                <input require type="password" placeholder='Nhập password...' name='password'>
                <button type='submit' name='login'>Đăng nhập</button>
            </form>
            <a href="application/view/signup.php">Chưa có tài khoản ? Đến trang đăng ký</a>
        </div>
        
       
    </div>
  
</body>
</html>