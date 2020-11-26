function init() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = async function () {
        if (this.readyState === 4 || this.readyState === 200) {

            let data = JSON.parse(this.response);
            let dataTable = document.getElementById('data-table');
            while (dataTable.rows.length > 0) {
                dataTable.deleteRow(0);
            }
            data.forEach(item => {
                let tr = document.createElement('tr');
                let td1 = document.createElement('td');
                let td2 = document.createElement('td');
                let td3 = document.createElement('td');
                let td4 = document.createElement('td');

                let img1 = document.createElement('img');
                let img2 = document.createElement('img');

                img1.setAttribute('src', 'public/assets/icon/manageGroup/rename.png');
                img1.setAttribute('onclick', `renameGroup('${item.id}')`);

                img2.setAttribute('src', 'public/assets/icon/manageGroup/delete.png');
                img2.setAttribute('onclick', `deleteGroup('${item.id}')`);

                td1.appendChild(document.createTextNode(item.id));
                td2.appendChild(document.createTextNode(item.nameGroup));
                td3.appendChild(document.createTextNode(item.totalMember));
                td4.appendChild(img1);
                td4.appendChild(img2);
                td4.setAttribute('class', 'action');

                tr.appendChild(td1);
                tr.appendChild(td2);
                tr.appendChild(td3);
                tr.appendChild(td4);

                dataTable.appendChild(tr);


            });

        } else {

        }
    }

    xhttp.open('GET', `index.php?manage-group=${email}`, true);
    xhttp.send();
}

init();




var idGroupCreate, nameGroup, createGroupBtn;

function toggleBtnCreate() {
    idGroupCreate = document.getElementById('idGroupCreate').value.trim();
    nameGroup = document.getElementById('nameGroup').value.trim();
    idGroupCreate = String(idGroupCreate);
    nameGroup = String(nameGroup);
    if (idGroupCreate === '' || nameGroup === '') createGroupBtn.disabled = true;
    else createGroupBtn.disabled = false;
}


function openCreateForm() {

    let form_create = document.getElementsByClassName('form-create')[0];
    form_create.classList.toggle('display-block');


    idGroupCreate = document.getElementById('idGroupCreate');
    nameGroup = document.getElementById('nameGroup');
    idGroupCreate.value = '';
    nameGroup.value = '';
    createGroupBtn = document.getElementById('createGroupBtn');
    createGroupBtn.disabled = true;


}

function createGroup() {
    let xhttp1 = new XMLHttpRequest();
    xhttp1.onreadystatechange = function () {
        if (this.readyState === 4 || this.readyState === 200) {
            let alert = document.getElementsByClassName('alert')[0];
            let response = JSON.parse(this.response);
            if (response === true) {
                alert.style.backgroundColor = '#d4edda';
                alert.style.color = '#155724';
                alert.style.borderColor = '#c3e6cb';
                alert.innerHTML = 'TẠO NHÓM THÀNH CÔNG';
                init();
            } else {
                console.log(this.response)
                alert.style.backgroundColor = '#f8d7da';
                alert.style.color = '#721c24';
                alert.style.borderColor = '#f5c6cb';
                alert.innerHTML = "TẠO NHÓM THẤT BẠI, ĐÃ CÓ LỖI XẢY RA";
            }
        }
    }


    xhttp1.open('POST', 'index.php', true);
    xhttp1.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhttp1.send(`idGroupCreate=${idGroupCreate}&nameGroup=${nameGroup}&createGroup=true`);


}

function renameGroup($id) {
    var rename = prompt('Nhập tên mới của nhóm...');
    if(rename !== null) rename = rename.trim();
    let xhttp2 = new XMLHttpRequest();
    xhttp2.onreadystatechange = function () {
        if (this.readyState === 4 || this.readyState === 200) {
            let response = JSON.parse(this.response);
            if (response) {
                init();
            }
        }
    }
    
    if (rename !== '' && rename !== null) {
        xhttp2.open('POST', 'index.php', true);
        xhttp2.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp2.send(`idGroup=${$id}&rename=${rename}&renameGroup=true`);
    }

}

function deleteGroup($id) {

}