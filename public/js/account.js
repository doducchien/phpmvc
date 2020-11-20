var key = true;
var count = 0;

var imgHTML = document.getElementById('img-or');
var id_or_HTML = document.getElementById('id-or');
var name_or_HTML = document.getElementById('name-or');

var fullnameHTML = document.getElementById('fullname');
var emailHTML = document.getElementById('email');
var ageHTML = document.getElementById('age');

imgHTML.src = img;
id_or_HTML.innerHTML = id_or;
name_or_HTML.innerHTML = name_or;

fullnameHTML.value = fullname;
emailHTML.value = email;
ageHTML.value = age;

fullnameHTML.disabled = key;
emailHTML.disabled = key;
ageHTML.disabled = key;

function repair(){
    key = !key;
    fullnameHTML.disabled = key;
    emailHTML.disabled = key;
    ageHTML.disabled = key;

    let repair_btn = document.getElementsByClassName('repair')[0];
    repair_btn.innerHTML = key? 'Sửa': 'Hoàn thành';
    fullnameHTML.classList.toggle('border-top-left-right');
    // emailHTML.classList.toggle('border-top-left-right');
    ageHTML.classList.toggle('border-top-left-right');
    count++;
}

function confirm(){
    if(key && count > 0){
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if(this.readyState === 4 || this.readyState === 200){
                // console.log(this.response)
            }
        }
        xhttp.open('post', 'index.php', true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send(`email=${emailHTML.value.trim()}&fullname=${fullnameHTML.value.trim()}&age=${ageHTML.value.trim()}&confirm=true`);

        console.log(fullnameHTML.value.trim());
        alert("Sửa thành công");
    }
    else if(!key){
        // alert('Ấn hoàn thành trước khi ấn xác nhận')
    }
    
}