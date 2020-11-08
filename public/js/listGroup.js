var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function(){
    if(this.readyState == 4 || this.readyState == 200){
      
        result = JSON.parse(this.response)
        console.log(result);
        var listGroup = document.getElementById('list-group-menu');
        var html = '';
        result.forEach(item => {
            html +=`<li onclick="getGroup()"} class='a-group'>${item.nameGroup}</li>`;
        });
        listGroup.innerHTML = html;  
    }
}
xhttp.open('GET', 'index.php?listgroup=true', true);
xhttp.send();


function getGroup(){
    
    var xhttp1 = new XMLHttpRequest();
    xhttp1.onreadystatechange = function(){
        if(this.readyState == 4 || this.readyState == 200){
            console.log('hihi');
        }
    }
    // xhttp1.open('GET', 'index.php?idGroup=true', true);
    // xhttp1.send();

}