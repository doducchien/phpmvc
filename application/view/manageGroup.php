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
    <title>Manage group</title>
    <link rel="stylesheet" href="public/css/init.css">
    <link rel="stylesheet" href="public/css/header.css">
    <link rel="stylesheet" href="public/css/manageGroup.css">
    <script>
        var email = <?php echo json_encode($_SESSION['email'], JSON_HEX_TAG); ?>;
    </script>
    <script src="public/js/manageGroup.js"></script>
</head>
<body>
    <div class="manage-group">
        
        <?php include ("header.php")?>

        <div class="manage-group-content">
            <div class="create-group">
                <div class="gr-btn">
                    <button onClick='openCreateForm()' class='new-group'>Tạo nhóm mới</button>
                </div>
                <div class="form-create">
                    <h2>Tạo nhóm</h2>
                    <form>
                        <input require onkeyup="toggleBtnCreate()" id='idGroupCreate' name='idGroupCreate'  type="text" placeholder='Nhập id nhóm...'>
                        <input require onkeyup='toggleBtnCreate()' id='nameGroup' name='nameGroup'  type="text" placeholder="Nhập tên nhóm...">
                        <button id='createGroupBtn' onClick='createGroup()' type='button'>Xác nhận</button>

                        <div class="alert"></div>
                    </form>

                    
                </div>
            </div>
            
            <div id='table-group' class="table-group">
                <table>
                    <caption><h2>Danh sách nhóm được tạo</h2></caption>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên nhóm</th>
                            <th>Số lượng thành viên</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody id='data-table'></tbody>
                </table>
            </div>
        </div>
        


    </div>
   
    
    
    <script src="public/js/header.js"></script>
</body>
</html>