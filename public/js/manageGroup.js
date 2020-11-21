var xhttp = new XMLHttpRequest();
var result;
xhttp.onreadystatechange = async function(){
    if(this.readyState === 4 || this.readyState === 200){
        
        let data = JSON.parse(this.response);
        let dataTable = document.getElementById('data-table');
        data.forEach(item => {
            var tr = document.createElement('tr');
            let td1 = document.createElement('td');
            let td2 = document.createElement('td');
            let td3 = document.createElement('td');
            let td4 = document.createElement('td');

            let img1 = document.createElement('img');
            let img2 = document.createElement('img');

            img1.setAttribute('src', 'public/assets/icon/manageGroup/rename.png');
            img2.setAttribute('src', 'public/assets/icon/manageGroup/delete.png');

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
        dataTable.innerHTML = renderItem;
        
    }
    else{

    }
}
xhttp.open('GET', `index.php?manage-group=${email}`, true);
xhttp.send();