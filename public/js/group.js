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


var doc_content = document.getElementsByClassName('doc-content')[0];
var homeWork_content = document.getElementsByClassName('homework-content')[0];
var form_create_doc;

homeWork_content.style.display = 'flex';
doc_content.style.display = 'none';
initHomework();
initDoc();

function openControll(component) {
    if (component === 'doc') {

        doc_content.style.display = 'flex';
        homeWork_content.style.display = 'none';
        initDoc();

        form_create_doc = document.getElementById('form-create-doc');

    } else {
        doc_content.style.display = 'none';
        homeWork_content.style.display = 'flex';
        initHomework();
    }
}

function openFormCreateDoc() {
    form_create_doc = document.getElementById('form-create-doc');
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
    if (emailFromPHP !== creator && emailFromPHP !== creatorGroup) alert("Chỉ người tạo hoặc trưởng nhóm được xóa!");
    else {
        let xhttp4 = new XMLHttpRequest();
        xhttp4.onreadystatechange = function () {
            if (this.readyState == 4 || this.readyState == 200) {
                let response = JSON.parse(this.response);
                if (response === true) alert("Xóa thành công");
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

function initHomework() {
    var listHomework = document.getElementsByClassName('list-home-work')[0];
    let xhttp5 = new XMLHttpRequest();


    xhttp5.onreadystatechange = function () {
        if (this.readyState == 4 || this.readyState == 200) {
            // console.log(this.response)
            let response = JSON.parse(this.response);
            listHomework.innerHTML = '';
            let i = 0;
            response.forEach(item => {



                let li = document.createElement('li');
                let span1 = document.createElement('span');
                let span2 = document.createElement('span');
                let span3 = document.createElement('span');

                span1.setAttribute('class', 'bt bt' + i);
                span2.setAttribute('class', 'deadline deadline' + i);
                span3.setAttribute('class', 'action');





                let a = document.createElement('a');
                let img1 = document.createElement('img');
                let img2 = document.createElement('img');
                let img3 = document.createElement('img');


                a.setAttribute('href', `index.php?idG=${item.idG}&idHomework=${item.id}&creatorGroup=${creatorGroup}&detailHomework=${true}`);
                img1.setAttribute('src', "public/assets/icon/group/upload.png");
                img2.setAttribute('src', "public/assets/icon/manageGroup/rename.png");
                img3.setAttribute('src', "public/assets/icon/manageGroup/delete.png");

                img2.setAttribute('onClick', `editHomework('${item.id}', '${item.idG}', '${i}')`);
                img3.setAttribute('onClick', `deleteHomework('${item.id}', '${item.idG}')`);



                a.appendChild(img1);
                span3.appendChild(a);
                span3.appendChild(img2);
                span3.appendChild(img3);

                span1.appendChild(document.createTextNode(item.name));
                span2.appendChild(document.createTextNode("Hết hạn: " + timeToString(item.deadline)));
                span3.appendChild(a);
                span3.appendChild(img2);
                span3.appendChild(img3);

                li.appendChild(span1);
                li.appendChild(span2);
                li.appendChild(span3);
                listHomework.appendChild(li);
                i++;
            })

        }

    }
    xhttp5.open('POST', 'index.php', true);
    xhttp5.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp5.send(`listHomework=${true}&idGroup=${idGroupFromPHP}`);



}

function openFormCreateHomework() {
    var formAddBtvn = document.getElementById('form-add-btvn');
    var alertAddBTVN = document.getElementsByClassName('alert-add-btvn')[0];
    if (emailFromPHP == creatorGroup) {
        formAddBtvn.classList.toggle('display-block');
    } else {
        alertAddBTVN.style.opacity = '1';
        alertAddBTVN.style.marginTop = '20px';
        var timeout = setTimeout(() => {
            alertAddBTVN.style.opacity = '0';
            alertAddBTVN.style.marginTop = '100px';
            clearTimeout(timeout);
        }, 3000);

    }

}

function createFormBTVN() {
    var nameBTVN = document.getElementById('nameBTVN').value.trim();
    var emailAlert = document.getElementById('emailAlert').value.trim();
    var dateDeadline = document.getElementById('dateDeadline').value.trim();
    var timeDeadline = document.getElementById('timeDeadline').value.trim();

    if (nameBTVN !== '' && emailAlert !== '' && dateDeadline !== '' && timeDeadline !== '') {
        // console.log(nameBTVN);
        // console.log(emailAlert);
        // console.log(dateDeadline);
        // console.log(timeDeadline);
        let idHomework = String(Math.floor(Math.random() * 1000)) + String(Math.floor(Math.random() * 1000)) + String(Math.floor(Math.random() * 1000)) + String(Math.floor(Math.random() * 1000)) + String(Math.floor(Math.random() * 1000));


        let dateA = dateDeadline.split('-');
        let timeA = timeDeadline.split(':');
        let splitTime = dateA.concat(timeA);
        let deadline = new Date(splitTime[0], splitTime[1], splitTime[2], splitTime[3], splitTime[4]);
        deadline = Number(deadline);
        var now = new Date()
        now = Number(now);
        if (deadline - now <= 0) {
            alert("Không thể tạo deadline tại thời điểm quá khứ");
        } else {
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState === 4 || this.readyState === 200) {
                    initHomework();
                    let listMail = String(listMember);
                    let subject = "BTVN" + ' - ' + nameGroup;
                    let body = `Chào các bạn,\n Tôi vừa tạo một bài tập trên nhóm của chúng ta.\n Deadline của bài tập này là ${timeToString(deadline)}.\n Các bạn hoàn thành nó trước deadline này nhé.` + '\n' + " Cảm ơn !";
                    window.open(`mailto:${listMail}?subject=${subject}&body=${body}`);
                    console.log(listMember);
                }
            }
            xhttp.open('POST', 'index.php', true);
            xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhttp.send(`id=${idHomework}&idGroup=${idGroupFromPHP}&name=${nameBTVN}&emailAlert=${emailAlert}&deadline=${deadline}&createHomework=${true}`);
        }



    } else alert("Bạn phải nhập đầy đủ các trường thông tin");
}


function timeToString(timeNumber) {
    var time = new Date(timeNumber);
    var hours = time.getHours();
    var mi = time.getMinutes();
    var date = time.getDate();
    var month = time.getMonth() + 1;
    var year = time.getFullYear();

    hours = hours < 10 ? '0' + hours : hours;
    mi = mi < 10 ? '0' + mi : mi;
    date = date < 10 ? '0' + date : date;
    month = month < 10 ? '0' + month : month;

    return hours + ":" + mi + " - " + date + "/" + month + "/" + year;
}
var idHomework = '';
var idGHomework = '';
var indexHomework = null;

function editHomework(id, idG, i) {
    if (emailFromPHP == creatorGroup) {
        let editHomework = document.getElementsByClassName('edit-homework')[0];
        let formEdit = document.getElementsByClassName('form-edit')[0];
        let bt = (document.getElementsByClassName('bt' + i)[0]).textContent.trim();
        let editContent = document.getElementById('edit-content');
        // let editDate = document.getElementById('edit-date');
        // let editTime = document.getElementById('edit-time');
        idHomework = id;
        idGHomework = idG;
        indexHomework = i;

        console.log(bt)

        editContent.innerHTML = bt;

        editHomework.style.display = 'block';
        formEdit.style.display = 'block'


    } else alert("Chỉ admin nhóm có quyền chỉnh sửa");
}

function deleteHomework(id, idG) {
    console.log(id, idG);
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 || this.readyState == 200) {
            console.log(this.response)
            let response = JSON.parse(this.response);
            if (response) alert("Xóa thành công");
            else alert("Xóa thất bại! Đã có lỗi xảy ra");

            initHomework();

        }
    }
    xhttp.open('POST', 'index.php', true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send(`id=${id}&idGroup=${idG}&deleteHomework=${true}`);
}

function closeEditHomework() {
    let editHomework = document.getElementsByClassName('edit-homework')[0];
    let formEdit = document.getElementsByClassName('form-edit')[0];
    editHomework.style.display = 'none';
    formEdit.style.display = 'none';
}

function confirmEditHomework() {
    let editHomework = document.getElementsByClassName('edit-homework')[0];
    let formEdit = document.getElementsByClassName('form-edit')[0];
    let btn = document.getElementById('btn-xn');
    let editContent = document.getElementById('edit-content');
    let editDate = document.getElementById('edit-date');
    let editTime = document.getElementById('edit-time');

    if (editContent.value.trim() == '' || editContent.value.trim() == undefined ||
        editDate.value.trim() == '' || editDate.value.trim() == undefined ||
        editTime.value.trim() == '' || editTime.value.trim() == undefined) {

        alert('Bạn cần nhập đầy đủ các trường thông tin');
    } else {
        let dateA = editDate.value.split('-');
        let timeA = editTime.value.split(':');
        let splitTime = dateA.concat(timeA);
        let newDeadline = new Date(splitTime[0], splitTime[1] - 1, splitTime[2], splitTime[3], splitTime[4]);
        if (Number(newDeadline) - Number(new Date()) < 0) alert('Deadline phải là một thời điểm trong tương lai');
        else {
            console.log(newDeadline)
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 || this.readyState == 200) {

                    let response = JSON.parse(this.response);
                    editHomework.style.display = 'none';
                    formEdit.style.display = 'none';
                    if (response) {
                        initHomework();
                        alert("Cập nhật thành công");
                    } else alert("Đã có lỗi xảy ra!");

                }
            }
            xhttp.open('POST', 'index.php', true);
            xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhttp.send(`id=${idHomework}&idGroup=${idGHomework}&newName=${editContent.value.trim()}&newDeadline=${Number(newDeadline)}&editHomework=${true}`);
        }



    }

}

var memmber = '';

function openModalMember(email, idGroup) {
    memmber = email;
    var showMember = document.getElementsByClassName('showMember')[0];
    var editHomework = document.getElementsByClassName('edit-homework')[0];
    showMember.style.display = 'block';
    editHomework.style.display = 'block';
    var deleteMem = document.getElementsByClassName('delete-mem')[0];
    if (emailFromPHP === creatorGroup) deleteMem.innerHTML = "Xóa khỏi nhóm";
    else deleteMem.style.display = 'none';

    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 || this.readyState == 200) {
            let response = JSON.parse(this.response);
            console.log(response);
            let infomation = document.getElementsByClassName('infomation')[0];
            infomation.innerHTML = '';
            let div = document.createElement('div');
            let p1 = document.createElement('p');
            let p2 = document.createElement('p');
            let p3 = document.createElement('p');

            div.setAttribute('class', 'fullname')
            div.innerHTML = response.fullname;
            p1.innerHTML = response.email;
            p2.innerHTML = response.name_organization;
            p3.innerHTML = response.age;
            infomation.appendChild(div);
            infomation.appendChild(p1);
            infomation.appendChild(p2);
            infomation.appendChild(p3);




        }
    }
    xhttp.open('POST', 'index.php', true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send(`email=${email}&getInfoMember=${true}`);

}

function closeModalMember() {
    var showMember = document.getElementsByClassName('showMember')[0];
    var editHomework = document.getElementsByClassName('edit-homework')[0];
    showMember.style.display = 'none';
    editHomework.style.display = 'none';
}

function deleteMember() {

    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 || this.readyState == 200) {

            let response = JSON.parse(this.response);
            if(response){
                alert("Xóa thành viên thành công");
                location.reload();
            }
            else{
                alert("Xóa thành viên thất bại! đã có lỗi xảy ra");
            }

        }
    }
    xhttp.open('POST', 'index.php', true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send(`email=${memmber}&idGroup=${idGroupFromPHP}&deleteMemmber=${true}`);

}