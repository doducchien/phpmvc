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
                    
                    <!-- <li><img src="public/assets/icon/group/user.png"><span> Đỗ Đức Chiến</span></li>
                    <li><img src="public/assets/icon/group/user.png"><span> Đỗ Đức Chiến</span></li>
                    <li><img src="public/assets/icon/group/user.png"><span> Đỗ Đức Chiến</span></li>
                    <li><img src="public/assets/icon/group/user.png"><span> Đỗ Đức Chiến</span></li>
                    <li><img src="public/assets/icon/group/user.png"><span> Đỗ Đức Chiến</span></li>
                    <li><img src="public/assets/icon/group/user.png"><span> Đỗ Đức Chiến</span></li>
                    <li><img src="public/assets/icon/group/user.png"><span> Đỗ Đức Chiến</span></li>
                    <li><img src="public/assets/icon/group/user.png"><span> Đỗ Đức Chiến</span></li>
                    <li><img src="public/assets/icon/group/user.png"><span> Đỗ Đức Chiến</span></li>
                    <li><img src="public/assets/icon/group/user.png"><span> Đỗ Đức Chiến</span></li>
                    <li><img src="public/assets/icon/group/user.png"><span> Đỗ Đức Chiến</span></li> -->

                </ul>

            </div>
            <div class="right"></div>
        </div>
    </div>
    <script src="public/js/group.js"></script>
</body>
</html>