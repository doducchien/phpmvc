<header class='header'>
    <div class="img">
        <img src="public/assets/img/header/bklogo.png" alt="">
    </div>
    <div class="input">
        <form>
            <input onkeyup='controlDisable(this.value)' required id='idGroup' type="text" placeholder='Nhập id nhóm...' name='idGroup'>
            <button id='btn-search' onClick='showGroup()' type='button'>Tìm kiếm</button>
        </form>
            
    </div>
    <ul class="menu">
        <li><a href="">Trang chủ</a> </li>
        <li><a href="application/view/manageGroup.php">Quản lý nhóm</a> </li>
        <li><a href="">Tài liệu</a></li>
            
        <li><a href="">Liên hệ</a></li>
        <li class='acc'>
            <span onClick='toggleControllAcc()'><?php  echo $_SESSION['email']?></span>
            <div id='control-acc' class='control-acc'>
                <?php 
                    $email = $_SESSION['email'];
                    echo "<p><a href='index.php?account={$email}'>Tài khoản</a></p>";
                ?>
                
                <p><a href="index.php?logout=true">Đăng xuất</a></p>
            </div>
        </li>
    </ul>
</header>

<div id='show-group' class="show-group">
    <div class="info-group">
        <p id='name' class="name"></p>
        <div  class="id"> <img src='public/assets/icon/group/search.png'></img> <span id='id'></span></div>
        <div  class="creator"> <img src='public/assets/icon/group/user.png'></img> <span id='creator'></span></div>
        <div  class="count-member"><img src="public/assets/icon/group/group.png"> <span id='count'></span></div>
        <div class="btns">
            <button id='btn' class='tham-gia'>Tham gia</button>
            <button onClick="closeGroup()" class='dong'>Đóng</button>
        </div>
    </div>
</div>
