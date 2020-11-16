

var body = document.getElementById('body');
var form = document.getElementById('form');
var submit = document.getElementById('submit');
var password = document.getElementById('password');
var repassword = document.getElementById('repassword');
var samepass = document.getElementById('samepass');
form.addEventListener('change', ()=>{
    
     
     password.onkeyup = ()=>{
        if(password.value !== repassword.value) submit.disabled = true;
        else submit.disabled = false;
        
     }
     repassword.onkeyup = () =>{
        if(password.value !== repassword.value){
            samepass.classList.remove('done-samepass');
            samepass.classList.add('samepass');
            samepass.innerHTML = "Mật khẩu nhập lại phải giống mật khẩu vừa nhập"
            submit.disabled = true
        }
        else{
            samepass.classList.remove('samepass');
            samepass.classList.add('done-samepass')
            samepass.innerHTML = "Mật khẩu nhập lại đã khớp";
            submit.disabled = false;
        }
     }

     submit.onclick = ()=>{
         console.log('hihi');
     }
     
})


