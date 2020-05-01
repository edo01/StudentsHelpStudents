<!DOCTYPE html>
<!--
	login.php
-->
<?php 
    session_start();
    include 'model/dbHandler.php';
    include 'local.php';
    
    $dbhandler = new DbHandler();
    //uncomment this!!
    if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == true && $_GET["page"]=="login") {
    	header("location: index.php");
    }
    if(isset($_GET["page"])){
        if($_GET["page"]=="login"){
            $page_function = "loadLogin(false)";
        }else{
            $page_function = "loadSignup(false)";
        }
    }
    if(isset($_POST["submit"])){
        if($_POST["submit"] == "register"){
            if(!$dbhandler->usersExists("username",$_POST["username"]) && 
                !$dbhandler->usersExists("email",$_POST["email"])){
                if(isset($_POST["username"]) && isset($_POST["name"]) &&
                    isset($_POST["surname"]) && isset($_POST["email"]) &&
                    isset($_POST["password"]) && isset($_POST["class"])){
                    if($_POST["password"] == $_POST["password2"]){
                        if($dbhandler->insertNewUser($_POST["name"], $_POST["surname"], 
                        $_POST["username"], $_POST["email"], $_POST["class"],
                                $_POST["password"])){
                            echo"miao";
                            $_SESSION["logged_in"] = true;    
                            $_SESSION["username"] = $_POST["username"];
                            header("location: index.php");
                        }   
                    }else{
                        $page_function = "loadSignup(true,'password')";
                    }
                }else{
                    echo "Si è verificato un errore nella registrazione dell'utente al sito.<br>Si prega di contattatare l'amministratore";
                }
            }else{
                //da migliorare
                if($dbhandler->usersExists("email",$_POST["email"])){
                    $page_function = "loadSignup(true,'email')";  
                }else{
                    $page_function = "loadSignup(true,'username')";  
                }
            }
        }
    }
    if (isset($_POST["usernamel"]) && isset($_POST["passwordl"])){
        
        //check from db is required here
        if($dbhandler->login($_POST["usernamel"], $_POST["passwordl"])){
            $_SESSION["logged_in"] = true;    
            $_SESSION["username"] = $_POST["usernamel"];
            header("location: index.php");
        }
        else{
            //do something for telling to the user that the password or the user is incorrect
            $page_function = "loadLogin(true)";
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
        <script type="text/javascript" src="js/ajaxFunctions.js"></script>
        <script type="text/javascript" src="js/tools.js"></script>
    </head>
    <body onload="<?php echo $page_function;?>"></body>
</html>
