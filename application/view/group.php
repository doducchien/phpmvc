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
        <div class="group-content">
            <div class="left">

                <div class="top">
                    <p class="name"><?php echo($result[0]['nameGroup']) ?></p>
                    <div class="id"> <img src='public/assets/icon/group/search.png'></img> <span><?php echo($result[0]['idGroup']) ?></span></div>
                    <div class="creator"> <img src='public/assets/icon/group/user.png'></img> <span><?php echo($result[0]['fullname']) ?></span></div>
                </div>
                
                <div class='member-title'><img src="public/assets/icon/group/group.png"> <span>THÀNH VIÊN NHÓM</span></div>
                <ul class="list-member">
                    <?php
                        foreach($result[1]['listMember'] as $value){
                            echo("<li><img src='public/assets/icon/group/user.png'><span>$value</span></li>");
                        
                        }
                    
                    ?>

                </ul>

            </div>
            <div class="right">
                <div class="control">
                        <button onClick='openControll("post")' class='post'>Thảo luận</button>
                        <button onClick='openControll("doc")' class='doc'>Tài liệu</button>
                        <button onClick='openControll("homework")' class='homework'>Bài tập về nhà</button>
                </div>
                <div class="content">
                    <div class="post-content">

                    </div>
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
                            </table>
                        </div>
                        <div class="create-doc">
                            <button onClick='openFormCreateDoc()'>Thêm tài liệu</button>
                            <form id='form-create-doc'>
                                <h3>Tạo tài liệu</h3>
                                <input id='name-doc' type="text" placeholder='Nhập tên tài liệu...'>
                                <input id='link-doc' type="text" placeholder='Nhập link tài liệu...'>
                                <button onClick='createDoc()' type='button'>Tạo</button>
                            </form>
                        </div>
                        
                    </div>

                    <div class="homework-content"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var idGroupFromPHP = <?php echo json_encode($result[0]['idGroup'], JSON_HEX_TAG);?>;
    </script>

    <script src="public/js/group.js"></script>
    <script src="public/js/header.js"></script>

</body>
</html>