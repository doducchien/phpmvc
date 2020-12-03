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
    <title>Detal Homework</title>
    <link rel="stylesheet" href="public/css/init.css">
    <link rel="stylesheet" href="public/css/header.css">
    <link rel="stylesheet" href="public/css/homework.css">
    
</head>
<body>
    <div class="homework">
        <?php include ("header.php")?>

        <div class="homework-content">
            <div class="left">
                <h3><?php echo $result['name_group'];?></h3>
                <p>ID Group: <?php echo $result['id_group'];?></p>
                <p>Creator : <?php echo $result['creator_group'];?></p>
                <h4>Nội dung</h4>
                <p id='nameHomework'><?php echo $result['nameHomework'];?></p>
            </div>
            <div class="right">
                <button>Nộp bài</button>
            </div>
        </div>

        
    </div>
    <script>
        



    </script>
    <script src="public/js/home.js"></script>
    <script src="public/js/header.js"></script>
    <script src="public/js/homework.js"></script>
</body>
</html>