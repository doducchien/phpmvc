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
    <title>Sign up</title>
    <link rel="stylesheet" href="public/css/init.css" type="text/css">
    <link rel="stylesheet" href="public/css/signup.css" type="text/css">
</head>
<body id='body'>
    
    <div class="signup">
        <?php
            if(isset($result)){
                $statement = $result[0] . '-signup';
                $content = $result[1];
                print "<div class='$statement'>$content</div>";
            }
        ?>
        <div class="" id='samepass'></div>
        <div class="frame-signup">
            <img src="public/assets/img/signup/bklogo.png" alt="BKHN">
            <form action="index.php" method='POST' id='form'>
                <input required type="email" placeholder='Nhập email...' name='email' id='email'>
                <input required type="text" placeholder='Nhập họ tên bạn...' name='fullname' id='fullname'>
                <input required type="number" min='17' max = '100' placeholder='Nhập tuổi...' name='age' id='age'>
                <input required type="text" placeholder='Nhập id của tổ chức bạn...' name='id_organization' id='_organization'>
                <input required type="password" placeholder='Nhập password...' name='password' id='password' minlength='8'>
                <input required type="password" placeholder='Nhập lại password...' name='repassword' id='repassword'>
                <button type='submit' name='signup' id='submit'>Đăng ký</button>
            </form>
            <a href="application/view/login.php">Đến trang đăng nhập</a>
            
        </div>
    </div>
    <script src="public/js/signup.js"></script>
</body>
</html>