var xhttp = new XMLHttpRequest();

function loadLogin(error){
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.body.innerHTML = this.responseText;
            //history.pushState(null,null,"access.php?page=login");
            if(error){
                document.getElementById("error").style.visibility = "visible";
            }
        }
    };
    xhttp.open("GET","login_content.php", true);
    xhttp.send();

}

function loadSignup(error, type){
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.body.innerHTML = this.responseText;
            //history.pushState(null,null,"access.php?page=signup");
            if(error){
                if(type=="email"){
                    document.getElementById("checker_email").style.visibility = "visible";
                }else if(type=="password"){
                    document.getElementById("password_error").style.visibility = "visible";
                }else{
                    document.getElementById("checker_username").style.visibility = "visible";
                }
            }
        }
    };
    xhttp.open("GET","signup_content.php", true);
    xhttp.send();
}

//not so much dynamic
function check_field(field, value){
    xhttp.onreadystatechange = function() {
        response = this.responseText.replace(/^\s*/,'').replace(/\s*$/,'').toLowerCase();
        if(response == 'true'){
            if(field == 'email'){
                document.getElementById("checker_email").style.visibility = "visible";
            }else{
                document.getElementById("checker_username").style.visibility = "visible";    
            }
        }else{
            if(field == 'email'){
                document.getElementById("checker_email").style.visibility = "hidden";
            }else{
                document.getElementById("checker_username").style.visibility = "hidden";    
            }
        }
    };
    xhttp.open("GET","checker.php?field=" + field + "&value=" + value.value,
        true);
    xhttp.send();
}

function loadMyProfile(){
    xhttp.open("GET","profile.php?", true);
    //xhttp.overrideMimeType("text/xml");
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
                document.getElementById("page").innerHTML = this.responseText;
        }
    }
    xhttp.send();
}

function loadExplore(){
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("page").innerHTML = this.responseText;
            loadQuestions('Lingua e letteratura italiana','5°');
        }
    };
    xhttp.open("GET","explore.php", true);
    xhttp.send();
}

function loadQuestions(matter,sect){
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("questions_box").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET","questions.php?matter="+ matter +"&sect="+sect, true);
    xhttp.send();
}