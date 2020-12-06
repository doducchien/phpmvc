<!DOCTYPE html>
<html lang="en">
<head>
    <base href="http://localhost/phpmvc/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group</title>
    <link rel="stylesheet" href="public/css/init.css" type="text/css">
    <link rel="stylesheet" href="public/css/group.css" type="text/css">
    <link rel="stylesheet" href="public/css/header.css" type="text/css">
</head>
<body>
    <div class="group">
        
        <?php include ('header.php') ?>
        <form class='form-edit'>
            <h3>Chỉnh sửa BTVN</h3>
            <textarea spellCheck='false' id='edit-content' placeholder='Nhập nội dung BTVN mới...'></textarea>
            <input id='edit-date' type="date">
            <input id='edit-time' type="time">
            <div class='btn-edit'>
                <button onClick='closeEditHomework()' id='btn-huy' type='button'>Huỷ</button>
                <button onClick='confirmEditHomework()' id='btn-xn' type='button'>Xác nhận</button>
            </div>
        </form>
        <div class="showMember">
            <div class='infomation'>
              
            </div>
            
            <div class='btn-member'>
                <button onClick='closeModalMember()' class='close-mem'>Đóng</button>
                <button onClick='deleteMember()' class='delete-mem'>Xóa khỏi nhóm</button>
            </div>
        </div>
        <div class="group-content">
            <div class="edit-homework">
                            
            </div>
            <div class="left">

                <div class="top">
                    <p class="name"><?php echo($result[0]['nameGroup']) ?></p>
                    <div class="id"> <img src='public/assets/icon/group/search.png'></img> <span><?php echo($result[0]['idGroup']) ?></span></div>
                    <div class="creator"> <img src='public/assets/icon/group/user.png'></img> <span><?php echo($result[0]['fullname']) ?></span></div>
                </div>
                
                <div class='member-title'><img src="public/assets/icon/group/group.png"> <span>THÀNH VIÊN NHÓM</span></div>
                <ul class="list-member">
                    <?php
                        $idGroup = $result[0]['idGroup'];
                        foreach($result[1]['listMember'] as $value){
                            echo("<li onClick='openModalMember(`$value`, `$idGroup`)'><img src='public/assets/icon/group/user.png'><span>$value</span></li>");
                        
                        }
                    
                    ?>

                </ul>

            </div>
            <div class="right">
                <div class="control">
                    <button onClick='openControll("homework")' class='homework'>Bài tập về nhà</button>
                    <button onClick='openControll("doc")' class='doc'>Tài liệu</button>
                        
                </div>
                <div class="content">
                    <div class="doc-content">
                        <div class="table-doc">
                            <table>
                                <caption><h2>Danh sách tài liệu</h2></caption>
                                <thead>
                                    <tr>
                                        <th class='stt-doc'>STT</th>
                                        <th>Tên tài liệu</th>
                                        <th>Link</th>
                                        <th>Người tạo</th>
                                        <th>Hành động</th>
                                    </tr>
                                    
                                </thead>
                                <tbody id='data-table-doc'>

                                </tbody>
                            </table>
                        </div>

                        <div class="create-doc">
                            <button onClick='openFormCreateDoc()'>Thêm tài liệu</button>
                            <form id='form-create-doc'>
                                <h3>Tạo tài liệu</h3>
                                <input onkeyup='inputCreateDoc()' id='name-doc' type="text" placeholder='Nhập tên tài liệu...' autocomplete='off'>
                                <input onkeyup='inputCreateDoc()' id='link-doc' type="text" placeholder='Nhập link tài liệu...' autocomplete='off'>
                                <button id='btn-create-doc' onClick='createDoc()' type='button'>Tạo</button>
                                <div id='alert-doc'></div>
                            </form>
                        </div>
                        
                    </div>

                    <div class="homework-content">
                        
                        <ul class="list-home-work"></ul>
                        <div class="create-homework">
                            <button onClick='openFormCreateHomework()' id='add-btvn'>Thêm BTVN</button>
                            <form id='form-add-btvn' action="">
                                <h3>Thêm BTVN</h3>
                                <textarea  id='nameBTVN' placeholder='Nhập nội dung BTVN...'></textarea>
                                <input require id='emailAlert' type="email" placeholder='Nhập email thông báo...'>
                                <input require id='dateDeadline' type="date" placeholder='Nhập ngày deadline...'>
                                <input require id='timeDeadline' type="time" placeholder='Nhập giờ deadline...'>
                                <button onClick='createFormBTVN()' id='add-btn-form' type='button'>Tạo</button>
                            </form>
                            <h4 class='alert-add-btvn'>CHỈ ADMIN CÓ QUYỀN THÊM BTVN</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

    <script>
        var nameGroup = <?php echo json_encode($result[0]['nameGroup'], JSON_HEX_TAG);?>;
        var listMember = <?php echo json_encode($result[1]['listMember'], JSON_HEX_TAG);?>;
        var creatorGroup = <?php echo json_encode($result[0]['creator'], JSON_HEX_TAG);?>;
        var idGroupFromPHP = <?php echo json_encode($result[0]['idGroup'], JSON_HEX_TAG);?>;
        var emailFromPHP = <?php echo json_encode($_SESSION['email'], JSON_HEX_TAG);?>
    </script>

    <script src="public/js/group.js"></script>
    <script src="public/js/header.js"></script>

</body>
</html>