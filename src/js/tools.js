function check_password(){
    if(document.getElementById("password").value != document.getElementById("password2").value){
        document.getElementById("password_error").style.visibility = "visible";
    }else{
        document.getElementById("password_error").style.visibility = "hidden";
    }
}