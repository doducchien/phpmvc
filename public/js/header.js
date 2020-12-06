function toggleControllAcc(){
    let control = document.getElementById('control-acc');
    control.classList.toggle('display-block');
}
var isJoin = false;
function showGroup(){
    let showGroup = document.getElementById('show-group');
    let xhttp = new XMLHttpRequest();
    var searchGroup = document.getElementById('idGroup').value.trim();
    xhttp.onreadystatechange = function(){
        if(this.readyState === 4 || this.readyState === 200){
            console.log(this.response);
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

            if(data[2] != null) isJoin = true;
            else isJoin = false;
            btn.onclick = function(){
                
                let xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function(){
                    if(this.readyState === 4 || this.readyState === 200){
                        let response = JSON.parse(this.response);
                        if(response){
                            
                            alert( isJoin ? "Rời khỏi nhóm thành công": 'Tham gia nhóm thành công');
                            location.reload();
                        }
                        else{
                            alert( isJoin? "Rời khỏi nhóm thất bại": "Tham gia nhóm thất bại");
                        }
                    }
                }

                xhttp.open('POST', 'index.php', true);
                xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                let body;
                if(isJoin){
                    body = `idGroup=${searchGroup}&leaveGroup=${true}`;
                }
                else{
                    body = `idGroup=${searchGroup}&joinGroup=${true}`
                }
                xhttp.send(body);
            }

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
    isJoin = false;
}
