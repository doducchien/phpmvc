var deadlineHomework = document.getElementById('deadline-homework');


deadlineHomework.style.fontSize = '16px'
deadlineHomework.appendChild(document.createTextNode("Deadline: " + timeToString(resultFromPHP.deadline)));
console.log(resultFromPHP);
console.log(idHomeworkPHP)





function timeToString(timeNumber) {
    var time = new Date(timeNumber);
    var hours = time.getHours();
    var mi = time.getMinutes();
    var date = time.getDate();
    var month = time.getMonth();
    var year = time.getFullYear();

    hours = hours < 10 ? '0' + hours : hours;
    mi = mi < 10 ? '0' + mi : mi;
    date = date < 10 ? '0' + date : date;
    month = month < 10 ? '0' + month : month;

    return hours + ":" + mi + " - " + date + "/" + month + "/" + year;
}

function initListSubmiter(){
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState === 4 || this.readyState === 200){
            let response = JSON.parse(this.response);
            // console.log(this.response);
            let menuSubmited = document.getElementsByClassName('menu-submited')[0];
            menuSubmited.innerHTML = '';
            
            let i = 1;
            response.forEach(item => {
                let li = document.createElement('li');
                li.setAttribute('onClick', `openModal("${item.submiter}")`)
                li.appendChild(document.createTextNode(i + '. ' + item.submiter));
                menuSubmited.appendChild(li);
                i++;
            });
        }
    }
    xhttp.open('POST', `index.php`);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send(`idHomework=${idHomeworkPHP}&idGroup=${resultFromPHP.id_group}&getSubmiter=${true}`)
}


initListSubmiter();


function timeToString(timeNumber) {
    var time = new Date(timeNumber);
    var hours = time.getHours();
    var mi = time.getMinutes();
    var date = time.getDate();
    var month = time.getMonth();
    var year = time.getFullYear();

    hours = hours < 10 ? '0' + hours : hours;
    mi = mi < 10 ? '0' + mi : mi;
    date = date < 10 ? '0' + date : date;
    month = month < 10 ? '0' + month : month;

    return hours + ":" + mi + " - " + date + "/" + month + "/" + year;
}

function scoreAndCmt(){
    
    if(emailFromPHP === resultFromPHP.creator_group){
        if(point.value.trim() === '' || cmt.value.trim() === ''){
            alert("Phải điền đầy đủ điểm và nhận xét");
        }
    }
}
var modal = document.getElementsByClassName('modal')[0];
var modalForm = document.getElementsByClassName('modal-form')[0];
modal.style.display = 'none';
modalForm.style.display = 'none';

function openModal(submiter){
    modal.style.display = 'block';
    modalForm.style.display = 'block';
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 || this.readyState == 200){
            let response = JSON.parse(this.response);
            let listSubmited = document.getElementsByClassName('list-submited')[0];
            listSubmited.innerHTML = '';
            let length = response.length;
            let i = length;
            response.forEach(item=>{
                let li = document.createElement('li');
                a = document.createElement('a');
                a.setAttribute('href', item.link)
                a.appendChild(document.createTextNode('Nộp lần ' + i + ' lúc ' + timeToString(item.time)));
                li.appendChild(a);
                i--;
                listSubmited.appendChild(li);
            })
        }
    }
    xhttp.open('POST', 'index.php', true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send(`idHomework=${idHomeworkPHP}&idGroup=${resultFromPHP.id_group}&submiter=${submiter}&checkSubmited=${true}`);

    function timeToString(timeNumber) {
        var time = new Date(timeNumber);
        var hours = time.getHours();
        var mi = time.getMinutes();
        var date = time.getDate();
        var month = time.getMonth();
        var year = time.getFullYear();
    
        hours = hours < 10 ? '0' + hours : hours;
        mi = mi < 10 ? '0' + mi : mi;
        date = date < 10 ? '0' + date : date;
        month = month < 10 ? '0' + month : month;
    
        return hours + ":" + mi + " - " + date + "/" + month + "/" + year;
    }
}
function closeModal(){
    modal.style.display = 'none';
    modalForm.style.display = 'none';
}
