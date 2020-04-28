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

function check_field(field, value){
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            $response = this.responseText.replace(/^\s*/,'').replace(/\s*$/,'').toLowerCase();
            console.log("miao");
            if($response == 'true'){
                document.getElementById("checker_username").style.visibility = "visible";
            }else{
                document.getElementById("checker_username").style.visibility = "hidden";
            }
        }
    };
    //alert(value.value);
    xhttp.open("GET","checker.php?field=" + field + "&value=" + value.value,
        true);
    xhttp.send();
}