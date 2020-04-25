<!DOCTYPE html>
<!--
	 signup.php
-->
<?php 
    session_start();
?>
<?php
    //si settano i cookie prima di tutto nel caso di accesso corretto
    include 'validation.php';//includere le funzioni per la validazione dei dati
    if(!(!is_logged() || empty($_POST["username"]) || empty($_POST["password"]))){
        $_SESSION["username"] = $_POST["username"];
        $_SESSION["logged"] = "1";
    }else{//nel caso di arrivo alla home page si eliminano tutti i cookies così da poter riaccedere
	//TODO:non so quanto sia necessario questo.    
	if(session_status()==PHP_SESSION_ACTIVE){
            session_destroy();
        }
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>signup</title>
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
        <div id="body">
        <?php if(!is_logged() || empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["password2"]) ||
		strcmp($_POST["password"], $_POST["password2"]) != 0 ): ?>
	    <div>
		<h1>BENVENUTO </h1>
	    </div>
	    <div>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
                <h4>username:</h4>
                <input type="text" name="username" value="<?php if(!empty($_POST["username"]))echo $_POST["username"];?>">
            <?php if(is_valid("username")):?>
                <h2 class="error">è necessario inserire l'username</h2>
            <?php endif;?>
	        <br>
		<h4>password:</h4>
	    <?php if(is_valid("password"))>
		<input type="password" name="password">
	        <br>
                <h4>ripeti password:</h4>
                <input type="password" name="password2">
            <?php if(is_valid("password")): ?>
                <h2 class="error">è necessario inserire la password</h2>
            <?php endif;?>
                <br>
		<input type="submit" value="registrati">
	    </div>	    
            </form>
        <?php endif;>
        </div>
    </body>
</html>
