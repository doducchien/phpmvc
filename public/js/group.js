document.getElementById('btn-search').disabled = true;


function controlDisable(val) {
    var btnSearch = document.getElementById('btn-search');
    if (val === '') {
        btnSearch.disabled = true;
    } else btnSearch.disabled = false;
}

function showGroup() {
    let showGroup = document.getElementById('show-group');
    let xhttp = new XMLHttpRequest();
    var searchGroup = document.getElementById('idGroup').value.trim();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 || this.readyState === 200) {
            let data = JSON.parse(this.response);
            let name = document.getElementById('name');
            let id = document.getElementById('id');
            let creator = document.getElementById('creator');
            let count = document.getElementById('count');
            let btn = document.getElementById('btn');

            name.innerHTML = data[0].nameGroup;
            id.innerHTML = data[0].idGroup;
            creator.innerHTML = data[0].fullname;
            count.innerHTML = 'Nhóm có tất cả ' + data[1] + ' thành viên';
            btn.innerHTML = data[2] != null ? 'Rời khỏi nhóm' : 'Tham gia';
            showGroup.style.display = 'block';
        }
    }

    xhttp.open('GET', `index.php?searchGroup=${searchGroup}`);
    xhttp.send();
    showGroup.style.display = 'block';
}

function closeGroup() {
    var showGroup = document.getElementById('show-group');
    showGroup.style.display = 'none';
}

var post_content = document.getElementsByClassName('post-content')[0];
var doc_content = document.getElementsByClassName('doc-content')[0];
var homeWork_content = document.getElementsByClassName('homework-content')[0];
var form_create_doc;
post_content.style.opacity = '0';
doc_content.style.opacity = '0';
homeWork_content.style.opacity = '0';

function openControll(component) {
    if (component === 'post') {
        post_content.style.opacity = '1';
        doc_content.style.opacity = '0';
        homeWork_content.style.opacity = '0';
    } else if (component === 'doc') {
        post_content.style.opacity = '0';
        doc_content.style.opacity = '1';
        homeWork_content.style.opacity = '0';
        initDoc();

        form_create_doc = document.getElementById('form-create-doc');

    } else {
        post_content.style.opacity = '0';
        doc_content.style.opacity = '0';
        homeWork_content.style.opacity = '1';
    }
}

function openFormCreateDoc() {

    form_create_doc.classList.toggle('display-block');
    let btnCreateDoc = document.getElementById('btn-create-doc');
    let nameDoc = document.getElementById('name-doc');
    let linkDoc = document.getElementById('link-doc');
    let alertDoc = document.getElementById('alert-doc');
    alertDoc.innerHTML = '';
    alertDoc.style.padding = '0';
    nameDoc.value = '';
    linkDoc.value = '';
    btnCreateDoc.disabled = true;
}

function createDoc() {
    let nameDoc = document.getElementById('name-doc').value.trim();
    let linkDoc = document.getElementById('link-doc').value.trim();

    let xhttp1 = new XMLHttpRequest();

    xhttp1.onreadystatechange = function () {
        if (this.readyState === 4 || this.readyState === 200) {
            let response = JSON.parse(this.response);
            let alert = document.getElementById('alert-doc');
            if (response) {
                alert.innerHTML = "THÊM TÀI LIỆU THÀNH CÔNG";
                alert.style.backgroundColor = 'green';
                alert.style.padding = '5px';
                alert.style.color = 'white';
                initDoc();
            } else {
                alert.innerHTML = "THÊM TÀI LIỆU THẤT BẠI. ĐÃ CÓ LỖI XẢY RA";
                alert.style.backgroundColor = 'red';
                alert.style.color = 'white';
                alert.style.padding = '5px';
            }
        }
    }
    var idDoc = String(Math.floor(Math.random() * 1000)) + String(Math.floor(Math.random() * 1000)) + String(Math.floor(Math.random() * 1000)) + String(Math.floor(Math.random() * 1000))
    xhttp1.open('POST', 'index.php', true);
    xhttp1.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp1.send(`idGroup=${idGroupFromPHP}&idDoc=${idDoc}&nameDoc=${nameDoc}&linkDoc=${linkDoc}&createDoc=${true}`);

}

function initDoc() {
    let xhttp2 = new XMLHttpRequest();
    xhttp2.onreadystatechange = function () {
        if (this.readyState === 4 || this.readyState === 200) {
            let response = JSON.parse(this.response);
            if (response !== false) {
                let index = 1;
                let dataTableDoc = document.getElementById('data-table-doc');
                while (dataTableDoc.rows.length > 0) dataTableDoc.deleteRow(0);
                response.forEach(item => {
                    let tr = document.createElement('tr');
                    let td1 = document.createElement('td');
                    let td2 = document.createElement('td');
                    let td3 = document.createElement('td');
                    let td4 = document.createElement('td');
                    let td5 = document.createElement('td');

                    let img1 = document.createElement('img');
                    let img2 = document.createElement('img');

                    let a = document.createElement('a');
                    a.innerHTML = item.link;
                    a.setAttribute('href', item.link);
                    a.setAttribute('target', '_blank');

                    img1.setAttribute('src', 'public/assets/icon/manageGroup/rename.png');
                    img1.setAttribute('onclick', `reDoc('${item.id}', '${item.creator}', '${item.name}', '${item.link}')`);

                    img2.setAttribute('src', 'public/assets/icon/manageGroup/delete.png');
                    img2.setAttribute('onclick', `deleteDoc('${item.id}', '${item.creator}')`);

                    td1.appendChild(document.createTextNode(index));
                    td2.appendChild(document.createTextNode(item.name));
                    td3.appendChild(a);
                    td4.appendChild(document.createTextNode(item.creator));

                    td5.appendChild(img1);
                    td5.appendChild(img2);

                    tr.appendChild(td1);
                    tr.appendChild(td2);
                    tr.appendChild(td3);
                    tr.appendChild(td4);
                    tr.appendChild(td5);
                    dataTableDoc.appendChild(tr);
                    index++;
                })
            }
        }
    }
    xhttp2.open('POST', 'index.php', true);
    xhttp2.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhttp2.send(`idGroup=${idGroupFromPHP}&getListDoc=${true}`);
}

function reDoc(id, creator, name, link) {
    if (emailFromPHP !== creator) {
        alert('Chỉ bản thân người tạo có quyền chỉnh sửa');
    } else {
        let nameDoc = prompt('Tên tài liệu', name);
        let linkDoc = prompt('Link tài liệu', link);
        if (nameDoc !== null) nameDoc = nameDoc.trim();
        if (linkDoc !== null) linkDoc = linkDoc.trim();

        let xhttp3 = new XMLHttpRequest();
        xhttp3.onreadystatechange = function () {
            if (this.readyState === 4 || this.readyState === 200) {
                let response = JSON.parse(this.response);
                if (response) {
                    initDoc();
                } else alert("Chỉnh sửa thất bại");
            }
        }
        if (nameDoc !== null && nameDoc !== '' && linkDoc !== null && linkDoc !== '') {
            xhttp3.open('POST', 'index.php', true);
            xhttp3.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhttp3.send(`idDoc=${id}&newName=${nameDoc}&newLink=${linkDoc}&editDoc=${true}`);
        }

    }

}

function deleteDoc(id, creator) {
    if(emailFromPHP !== creator && emailFromPHP !== creatorGroup) alert("Chỉ người tạo hoặc trưởng nhóm được xóa!");
    else{
        let xhttp4 = new XMLHttpRequest();
        xhttp4.onreadystatechange = function(){
            if(this.readyState == 4 || this.readyState == 200){
                let response = JSON.parse(this.response);
                if(response === true) alert("Xóa thành công");
                else alert("Xóa thất bại.");

                initDoc();  
            }
        }
        xhttp4.open('POST', 'index.php', true);
        xhttp4.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp4.send(`idDoc=${id}&deleteDoc=${true}`);
    }
}

function inputCreateDoc() {
    let btnCreateDoc = document.getElementById('btn-create-doc');

    let nameDoc = document.getElementById('name-doc').value.trim();
    let linkDoc = document.getElementById('link-doc').value.trim();

    if (nameDoc === '' || linkDoc === '') btnCreateDoc.disabled = true;
    else btnCreateDoc.disabled = false;
}