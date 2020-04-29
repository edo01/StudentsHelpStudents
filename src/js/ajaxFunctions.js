var xhttp = new XMLHttpRequest();

function loadLogin(){
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("content").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET","login_content.php", true);
    xhttp.send();
}

function loadSignup(){
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("content").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET","signup_content.php", true);
    xhttp.send();
}

//not so much dynamic
function check_field(field, value){
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
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
        }
    };
    xhttp.open("GET","checker.php?field=" + field + "&value=" + value.value,
        true);
    xhttp.send();
}

function loadMyProfile(username){
    xhttp.overrideMimeType("text/xml");
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
               var userData = this.responseXML;
                //alert(this.responseText);
                console.log(userData.getElementsByTagName("name")[0].childNodes[0].nodeValue);
                //document.getElementById("page").innerHTML = this.responseText;
        }
    }
    xhttp.open("GET","Profile.php?username="+username, true);
    xhttp.send();
}