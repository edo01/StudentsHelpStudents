<!DOCTYPE html>
<!--
	login.php
-->
<?php 
    session_start();

    include 'model/dbHandler.php';

    if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == true) {
    	header("location: index.php");
    }

    if (isset($_POST["username"]) && isset($_POST["password"])){
    	//check from db is required here
	    if(login($_POST["username"], $_POST["password"])){
		$_SESSION["logged_in"] = true;    
		$_SESSION["username"] = $_POST["username"];
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
    </head>
    <body>
        <div>
<?php if(!is_logged() || empty($_POST["username"]) || empty($_POST["password"])){?>
            <h1>BENVENUTO</h1>
	    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
                <h4>username:</h4>
                <input type="text" name="username" value="<?php if(!empty($_POST["username"]))echo $_POST["username"];?>">
	<?php if(is_valid("username")):?>
                <h2 class="error">è necessario inserire l'username</h2>
        <?php endif;?>
                <br>
                <h4>password:</h4>
                <input type="password" name="password">
        <?php if(is_valid("password")): ?>
                <h2 class="error">è necessario inserire la password</h2>
        <?php endif;?>
                <br>
                <input type="submit" value="login"><h3> oppure </h3> <a href="signup.html">registrati</a>            
            </form>
<?php }?>
        </div>
    </body>
</html>
