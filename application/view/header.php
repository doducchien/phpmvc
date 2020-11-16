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
        <li><a href="application/view/addGroup.php">Thêm nhóm</a> </li>
        <li><a href="">Tài liệu</a></li>
            
        <li><a href="">Liên hệ</a></li>
        <li><a href="">Tài khoản</a></li>
    </ul>
</header>

<div id='show-group' class="show-group">
    <div class="info-group">
        <p class="name">Phương Pháp Tính</p>
        <div class="id"> <img src='public/assets/icon/group/search.png'></img> <span>111111</span></div>
        <div class="creator"> <img src='public/assets/icon/group/user.png'></img> <span>Do Duc Chien</span></div>
        <div class="count-member"><img src="public/assets/icon/group/group.png"> <span>Có 50 thành viên</span></div>
        <div class="btns">
            <button class='tham-gia'>Tham gia</button>
            <button onClick="closeGroup()" class='dong'>Đóng</button>
        </div>
    </div>
</div>
