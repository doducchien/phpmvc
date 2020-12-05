var deadlineHomework = document.getElementById('deadline-homework');
var formSMhomework = document.getElementById('form-sm-homework');
var btnPointCmt = document.getElementById('xn-point-cmt');
var point = document.getElementById('point');
var cmt = document.getElementById('cmt')


point.disabled = 'true';
cmt.disabled = 'true';


deadlineHomework.style.fontSize = '16px'
deadlineHomework.appendChild(document.createTextNode("Deadline: " + timeToString(resultFromPHP.deadline)));
console.log(resultFromPHP);
console.log(idHomeworkPHP)

function submitHomework() {
    var linkSubmitHomework = document.getElementById('link-submit-homework');

    if (linkSubmitHomework.value.trim() === '' || linkSubmitHomework.value.trim() === undefined) {
        alert("Phải điền link nộp bài");
    } else {
        let id = new String(Math.floor(Math.random() * 1000)) + String(Math.floor(Math.random() * 1000)) + String(Math.floor(Math.random() * 1000)) + String(Math.floor(Math.random() * 1000)) + String(Math.floor(Math.random() * 1000));
        let timeSubmit = Number(new Date());
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 || this.readyState === 200) {
                let response = JSON.parse(this.response);
                if (response) {
                    var linkSubmitHomework = document.getElementById('link-submit-homework');
                    initHomework1();
                    alert("Nộp bài tập thành công");
                    linkSubmitHomework.value = '';

                } else {
                    alert('Nộp bài tập thất bại !');
                }
            }
        }
        xhttp.open('POST', `index.php`);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send(`id=${id}&idHomework=${idHomeworkPHP}&idGroup=${resultFromPHP.id_group}&link=${linkSubmitHomework.value.trim()}&timeSubmit=${timeSubmit}&submitHomework=${true}`);
    }

}



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

function initHomework1() {

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 || this.readyState === 200) {
            let response = JSON.parse(this.response);
            console.log(response);
            let menuSubmited = document.getElementsByClassName('menu-submited')[0];
            menuSubmited.innerHTML = '';
            let length = response.length;
            let i = length;
            response.forEach(item => {
                let li = document.createElement('li');
                let a = document.createElement('a');
                a.setAttribute('href', item.link);
                a.appendChild(document.createTextNode('Đã nộp lần ' + i + ' vào lúc ' + timeToString(item.time)));
                li.appendChild(a);
                menuSubmited.appendChild(li);
                i--;
            });
        }
    }
    xhttp.open('POST', `index.php`);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send(`idHomework=${idHomeworkPHP}&idGroup=${resultFromPHP.id_group}&getSubmitedHomework=${true}`)
}


initHomework1();


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

function scoreAndCmt() {

    if (emailFromPHP === resultFromPHP.creator_group) {
        if (point.value.trim() === '' || cmt.value.trim() === '') {
            alert("Phải điền đầy đủ điểm và nhận xét");
        }
    }
}