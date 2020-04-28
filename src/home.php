<!DOCTYPE html>
<!--
	login.php
-->
<?php 
    session_start();
    include 'model/dbHandler.php';
    include 'local.php';
    $dbhandler = new DbHandler();
   /*if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == true) {
    	header("location: index.php");
    }*/
    
    
    
    if($_POST["submit"] = "registrati"){
        if(isset($_POST["username"]) && isset($_POST["name"]) &&
            isset($_POST["surname"]) && isset($_POST["email"]) &&
            isset($_POST["password"]) && isset($_POST["class"])){
            
            if($dbhandler->insertNewUser($_POST["name"], $_POST["surname"], 
            $_POST["username"], $_POST["email"], $_POST["class"],
                    $_POST["password"])){
                $_SESSION["logged_in"] = true;    
                $_SESSION["username"] = $_POST["username"];
                header("location: index.php");
                
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
        }
    }

   
?>
<html>
    <head>
        <meta charset="UTF-8">
	<title>login</title>
	<style>
            .error {
                color : red;
            }
            div {
                align-content: center;
            }
        </style>
        <script type="text/javascript" src="js/ajaxFunctions.js"></script>
    </head>
    <body onload="loadLogin()">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
            <div id="content"></div>
        </form>
    </body>
</html>
