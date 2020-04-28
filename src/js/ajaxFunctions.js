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