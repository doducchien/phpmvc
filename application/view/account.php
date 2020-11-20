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
    <link rel="stylesheet" href="public/css/header.css">
    <link rel="stylesheet" href="public/css/account.css">
    
</head>
<body>
    <div class="account">
        
            <?php include ("header.php")?>



        <div class="account-content">
            <div class="organization">
                <h2><img  src="public/assets/icon/account/organization.png"><span>Tổ chức</span></h2>
                <div class='logo-organization'><img id='img-or'></div>
                <div class="id"><img src="public/assets/icon/account/id.svg"><p id='id-or'>12345</p></div>
                <div class="id"><img src="public/assets/icon/account/school.png"><p id='name-or'>Trường Đại học Bách Khoa Hà Nội</p></div>

            </div>
            <div class="acc-detail">
                <form>
                    <img src="public/assets/img/account/face.png">
                    <div><input id='fullname' type="text"><img src="public/assets/icon/account/name.png"></div>
                    <div><input id='email' type="text"><img src="public/assets/icon/account/email.png"></div>
                    <div><input id='age' type="text"><img src="public/assets/icon/account/age.png"></div>
                    <div class="btn">
                        <button onClick='repair()' type='button' class='repair'>Sửa</button>
                        <button onClick='confirm()' type='button' class='confirm'>Xác nhận</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script>
        var img = <?php echo json_encode($result['img_organization'], JSON_HEX_TAG);?>;
        var id_or = <?php echo json_encode($result['id_organization'], JSON_HEX_TAG); ?>;
        var name_or = <?php echo json_encode($result['name_organization'], JSON_HEX_TAG); ?>;
        var email = <?php echo json_encode($result['email'], JSON_HEX_TAG); ?>;
        var fullname = <?php echo json_encode($result['fullname'], JSON_HEX_TAG); ?>;
        var age = <?php echo json_encode($result['age'], JSON_HEX_TAG); ?>;



    </script>
    <script src="public/js/home.js"></script>
    <script src="public/js/account.js"></script>
    <script src="public/js/header.js"></script>
</body>
</html>