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
    }
    else if(component === 'doc'){
        post_content.style.opacity = '0';
        doc_content.style.opacity = '1';
        homeWork_content.style.opacity = '0';

        form_create_doc = document.getElementById('form-create-doc');

    }
    else{
        post_content.style.opacity = '0';
        doc_content.style.opacity = '0';
        homeWork_content.style.opacity = '1';
    }
}

function openFormCreateDoc(){
    
    form_create_doc.classList.toggle('display-block');
}

function createDoc(){
    let nameDoc = document.getElementById('name-doc');
    let linkDoc = document.getElementById('link-doc');
    
    let xhttp1 = new XMLHttpRequest();

    xhttp1.onreadystatechange = function(){
        if(this.readyState === 4 || this.readyState === 200){
            // let response = JSON.parse(this.response);
            console.log(this.response);
        }
    }
    var idDoc = String(Math.floor(Math.random() * 1000)) + String(Math.floor(Math.random() * 1000)) + String(Math.floor(Math.random() * 1000)) + String(Math.floor(Math.random() * 1000))
    xhttp1.open('POST', 'index.php', true);
    xhttp1.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp1.send(`idGroup=${idGroupFromPHP}&idDoc=${idDoc}&nameDoc=${nameDoc}&linkDoc=${linkDoc}&createDoc=${true}`);

}