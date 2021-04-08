const password = document.getElementById('newPwd');
const confirmPwd = document.getElementById('verifyPwd');
const errorMsg  = document.getElementById('error-message');
const submit = document.getElementById('save');

confirmPwd.addEventListener("blur",()=>{
    if (password.value == confirmPwd.value) {
        password.style.border = "thin solid green";
        confirmPwd.style.border = "thin solid green";
        errorMsg.style.display = "none";
        submit.removeAttribute("disabled");
    } else {
        password.style.border = "thin solid red";
        confirmPwd.style.border = "thin solid red";
        errorMsg.style.display = "inline";
        submit.removeAttribute("disabled","true");
    }
})
