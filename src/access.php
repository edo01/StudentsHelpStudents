<!DOCTYPE html>
<!--
                                access.php
    This page is used for both the sign up and the log in. The page is chosen 
    basing on the 'page' camp passed with the GET. The contents of the login and 
    of the signup are inside the two file "login_content.php" and "signup.php". 
-->
<?php 
    session_start();
    include 'model/dbHandler.php';
    include 'local.php';
    
    $dbhandler = new DbHandler();
    //if you click login and you have done the login recently, the site remember you and let you in
    if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == true && $_GET["page"]=="login") {
    	header("location: index.php");//redirect to index.php
    }
    //chosing the page in base on the 'page' GET camp
    if(isset($_GET["page"])){
        if($_GET["page"]=="login"){
            $page_function = "loadLogin(false)";
        }else{
            $page_function = "loadSignup(false)";
        }
    }
    //if submit is clicked login or register button was clicked.
    if(isset($_POST["submit"])){
        //controls if it was a register submit or a login submit
        if($_POST["submit"] == "register"){
            /*checks if the camps 'username' and 'email' doesn't already exist 
             * inside the database
             */
            if(!$dbhandler->usersExists("username",$_POST["username"]) && 
                !$dbhandler->usersExists("email",$_POST["email"])){
                //controls if the camps are sets and not null
                if(isset($_POST["username"]) && isset($_POST["name"]) &&
                    isset($_POST["surname"]) && isset($_POST["email"]) &&
                    isset($_POST["password"]) && isset($_POST["class"])){
                    //controls if the password are equal
                    if($_POST["password"] == $_POST["password2"]){
                        //insert the new user inside the database
                        if($dbhandler->insertNewUser($_POST["name"], $_POST["surname"], 
                        $_POST["username"], $_POST["email"], $_POST["class"],
                                $_POST["password"])){
                            //setting session's coockies
                            $_SESSION["logged_in"] = true;    
                            $_SESSION["username"] = $_POST["username"];
                            //redirecting to the index page
                            header("location: index.php");
                        }else{
                            echo "Si è verificato un errore nella registrazione dell'utente al sito.<br>Si prega di contattatare l'amministratore";
                        }
                    }else{
                        //reload the signup page with "password error"
                        $page_function = "loadSignup(true,'password')";
                    }
                }else{
                    echo "Si è verificato un errore nella registrazione dell'utente al sito.<br>Si prega di contattatare l'amministratore";
                }
            }else{
                if($dbhandler->usersExists("email",$_POST["email"])){
                    //reload the signup page with "email error"
                    $page_function = "loadSignup(true,'email')";  
                }else{
                    //reload the signup page with "username error"
                    $page_function = "loadSignup(true,'username')";  
                }
            }
        } else if (isset($_POST["usernamel"]) && isset($_POST["passwordl"])){
            //checking camps in db
            if($dbhandler->login($_POST["usernamel"], $_POST["passwordl"])){
                //setting session's coockies
                $_SESSION["logged_in"] = true;    
                $_SESSION["username"] = $_POST["usernamel"];
                //redirecting to the index page
                header("location: index.php");
            }
            else{
                //reload the page: username or password are incorrect 
                $page_function = "loadLogin(true)";
            }
        }
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ShS</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/materialize.min.css">
        <link rel="stylesheet" href="css/tooplate.css">        
        
        <link rel="icon" href="favicon.ico">
        
        <script type="text/javascript" src="js/ajaxFunctions.js"></script>
        <script type="text/javascript" src="js/tools.js"></script>
    </head>
    <body id ="login" onload="<?php echo $page_function;?>"></body>
</html>
