<?php
if(!defined('DS')){
    define('DS', DIRECTORY_SEPARATOR);
    define('PATH_SYSTEM', __DIR__.DS. '..' . DS . '..' . DS . DS . 'system');
    define('PATH_APP', __DIR__.DS.'..' . DS . '..' . DS . DS . 'application');
}

if(!isset($_SESSION)) session_start();

if(!isset($_SESSION['email'])){
    header("Location:" . DS . 'phpmvc' . DS . 'application' . DS . 'view' . DS .'login.php');
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
<base href="http://localhost/phpmvc/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="public/css/init.css">
    <link rel="stylesheet" href="public/css/home.css">
    <link rel="stylesheet" href="public/css/header.css">
    <link rel="stylesheet" href="public/css/listGroup.css">
    
</head>
<body>
    <div class="home">
        
            <?php include ("header.php")?>



        <div class="home-content">
            <div class="notifica">
                <?php include ("notifica.php")?>
            </div>
            <div id='list-group' class="list-group">
                <?php include ("listGroup.php") ?>
            </div>
        </div>
    </div>
    <script>
        emailFromPHP = <?php echo json_encode($_SESSION['email'], JSON_HEX_TAG); ?>
    </script>
    <script src="public/js/home.js"></script>
    <script src="public/js/listGroup.js"></script>
    <script src="public/js/header.js"></script>
</body>
</html>