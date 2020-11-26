
var xhttp = new XMLHttpRequest();
var data = 1;
xhttp.onreadystatechange = function(){
    if(this.readyState == 4 || this.readyState == 200){
      
        result = JSON.parse(this.response);
        console.log(result);
        var listGroup = document.getElementById('list-group-menu');
        var html = '';
        result.forEach(item => {
            let idGroup = item.idGroup;
            html +=`<li onclick={getGroup('${idGroup}')} class='a-group'>${item.nameGroup}</li>`;
        });
        listGroup.innerHTML = html;  
    }
}
xhttp.open('GET', 'index.php?listgroup=true', true);
xhttp.send();


function getGroup(idGroup){
    console.log(idGroup);
    window.location = `index.php?idGroup=${idGroup}`;

}

document.getElementById('btn-search').disabled = true;

function controlDisable(val){
    var btnSearch = document.getElementById('btn-search');
    if(val === ''){
        btnSearch.disabled = true;
    }
    else btnSearch.disabled = false;
}

function showGroup(){
    let showGroup = document.getElementById('show-group');
    let xhttp = new XMLHttpRequest();
    var searchGroup = document.getElementById('idGroup').value.trim();
    xhttp.onreadystatechange = function(){
        if(this.readyState === 4 || this.readyState === 200){
            let data = JSON.parse(this.response);
            let name = document.getElementById('name');
            let id = document.getElementById('id');
            let creator = document.getElementById('creator');
            let count = document.getElementById('count');
            let btn = document.getElementById('btn');

            name.innerHTML= data[0].nameGroup;
            id.innerHTML = data[0].idGroup;
            creator.innerHTML = data[0].fullname;
            count.innerHTML = 'Nhóm có tất cả ' + data[1] + ' thành viên';
            btn.innerHTML = data[2] != null ? 'Rời khỏi nhóm' : 'Tham gia';
            showGroup.style.display= 'block';
        }
        else{
            
        }
    }
    
    xhttp.open('GET', `index.php?searchGroup=${searchGroup}`);
    xhttp.send();
    
}
function closeGroup(){
    var showGroup = document.getElementById('show-group');
    showGroup.style.display= 'none';
}
