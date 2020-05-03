var xhttp = new XMLHttpRequest();
var actual_sect;
var actual_matter;

function loadLogin(error){
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.body.innerHTML = this.responseText;
            //history.pushState(null,null,"access.php?page=login");
            document.body.id  = "login";
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
            document.body.id  = "register";
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
    xhttp.open("GET","profile.php", true);
    //xhttp.overrideMimeType("text/xml");
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
                document.getElementById("page").innerHTML = this.responseText;
                document.body.id = "profile";
        }
    }
    xhttp.send();
}

function loadExplore(){
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("page").innerHTML = this.responseText;
            document.body.id = "explore";
            loadQuestions('Lingua e letteratura italiana','5°');
        }
    };
    xhttp.open("GET","explore.php", true);
    xhttp.send();
}

function loadQuestions(matter,sect){
    actual_sect = sect;
    actual_matter = matter;
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("questions_box").innerHTML = this.responseText;
            document.getElementById("src-bar-exp").style.display = "block";
        }
    };
    xhttp.open("GET","questions.php?matter="+ matter +"&sect="+sect, true);
    xhttp.send();
}

function loadQuestion(id){
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("questions_box").innerHTML = this.responseText;
            document.getElementById("src-bar-exp").style.display = "none";
            document.getElementById("answer-btn").style.display = "block";
        }
    };
    xhttp.open("GET","question.php?id="+ id, true);
    xhttp.send();
    
}

function searchQuestions(search){
    search = search.value;
    console.log(search);
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("questions_box").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET","questions.php?matter="+ actual_matter +"&sect="+actual_sect+"&search="+search, true);
    xhttp.send();
}

function loadClassification(){
    xhttp.open("GET","classification.php", true);
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
                document.getElementById("page").innerHTML = this.responseText;
                document.body.id = "classification";
        }
    }
    xhttp.send();
}

function loadAnswerForm(id){
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("answer_panel").innerHTML = this.responseText;
            document.getElementById("answer_aerea").focus();
            document.getElementById("answer-btn").style.display = "none";
        }
    };
    xhttp.open("GET","answerForm.php?id="+ id, true);
    xhttp.send();
}

function loadMyQuestions(){
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("page").innerHTML = this.responseText;
            document.body.id = "questions";
        }
    };
    xhttp.open("GET","myQuestionsPanel.php", true);
    xhttp.send();
}

function loadQuestion_s(id){
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("page").innerHTML = this.responseText;
            document.body.id = "explore";
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("questions_box").innerHTML = this.responseText;
                    document.getElementById("src-bar-exp").style.display = "none";
                    document.getElementById("answer-btn").style.display = "block";
                }
            };
            xhttp.open("GET","question.php?id="+ id, true);
            xhttp.send();
        }
    };
    xhttp.open("GET","explore.php", true);
    xhttp.send(); 
}

function removeQuestion(id){
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("page").innerHTML = this.responseText;
            document.body.id = "questions";
        }
    };
    xhttp.open("GET","myQuestionsPanel.php?remove=true&id="+id, true);
    xhttp.send();
}