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
    <title>Detail for Admin</title>
    <link rel="stylesheet" href="public/css/init.css">
    <link rel="stylesheet" href="public/css/header.css">
    <link rel="stylesheet" href="public/css/listSubmiter.css">
    
</head>
<body>
    <div class="homework">
        <?php include ("header.php")?>
        <div class='modal'></div>
        <div class="modal-form">
            <h3>Bài tập đã nộp</h3>
            <ul class="list-submited">
                <li>Nộp lần 1 lúc 09:09 - 20/11/2020</li>
            </ul>
            <form>
                <input type="number" placeholder="Nhập điểm...">
                <textarea type='text' placeholder='Nhập nhận xét...'></textarea>
                <div>
                    <button type='button' onClick='closeModal()'>Đóng</button>
                    <button class='xn-point-cmt' type='button'>Xác nhận</button>
                </div>
                
            </form>
        </div>
        <div class="homework-content">
            <div class="left">
                <h3><?php echo $result['name_group'];?></h3>
                <p>ID Group: <?php echo $result['id_group'];?></p>
                <p>Creator : <?php echo $result['creator_group'];?></p>
                <h4>Nội dung</h4>
                <p id='nameHomework'><?php echo $result['nameHomework'];?></p>
                <u id='deadline-homework'></u>
            </div>
            <div class="right">

                <div class="submited">
                    <h3>Các thành viên đã nộp bài tập</h3>
                    <ul class="menu-submited"></ul>
                </div>

                
                <!-- <div class='point'>
                    <u>Điểm số:</u> 
                    <input id='point' type="number" placeholder="Chưa được chấm điểm">
                </div>
                <div class='cmt'>
                    <u>Nhập xét của giáo viên</u>
                    <textarea id='cmt' placeholder="Chưa được nhận xét"></textarea>
                </div>
                
                <button onClick = 'scoreAndCmt()' id='xn-point-cmt'>Lưu điểm số và nhận xét</button> -->
                
            </div>
        </div>

        
    </div>
    <script>
        
        var resultFromPHP = <?php echo json_encode($result, JSON_HEX_TAG);?>;
        var idHomeworkPHP = <?php echo json_encode($id, JSON_HEX_TAG);?>;
        var emailFromPHP = <?php echo json_encode($_SESSION['email'], JSON_HEX_TAG);?>;

    </script>
    <script src="public/js/home.js"></script>
    <script src="public/js/header.js"></script>
    <script src="public/js/listSubmiter.js"></script>
</body>
</html>