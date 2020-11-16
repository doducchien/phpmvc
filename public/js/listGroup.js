
var xhttp = new XMLHttpRequest();
var data = 1;
xhttp.onreadystatechange = function(){
    if(this.readyState == 4 || this.readyState == 200){
      
        result = JSON.parse(this.response);
        console.log(result);
        var listGroup = document.getElementById('list-group-menu');
        var html = '';
        result.forEach(item => {
            html +=`<li onclick={getGroup(${item.idGroup})} class='a-group'>${item.nameGroup}</li>`;
        });
        listGroup.innerHTML = html;  
    }
}
xhttp.open('GET', 'index.php?listgroup=true', true);
xhttp.send();


function getGroup($idGroup){
    // var xhttp1 = new XMLHttpRequest();
    // xhttp1.onreadystatechange = function(){
    //     if(this.readyState == 4 || this.readyState == 200){
    //         data = JSON.parse(this.response);
            
    //     }
        
    // }
    // xhttp1.open('GET', `index.php?idGroup=${$idGroup}`, true);
    // xhttp1.send();

    window.location=`index.php?idGroup=${$idGroup}`;

}

document.getElementById('btn-search').disabled = true;

function controlDisable(val){
    var btnSearch = document.getElementById('btn-search');
    console.log(val)
    if(val === ''){
        btnSearch.disabled = true;
    }
    else btnSearch.disabled = false;
}

function showGroup(){
    var showGroup = document.getElementById('show-group');
    var idGroup = document.getElementById('idGroup').value.trim();
    showGroup.style.display= 'block';
}
function closeGroup(){
    var showGroup = document.getElementById('show-group');
    showGroup.style.display= 'none';
}
