<?php
	session_start();
	if(!isset($_SESSION['logged_in']) || $_SESSION["logged_in"]== false){
	header("location: login.php");
	}	
?>
<html>
    <head>
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

    <body onload="loadMyProfile()">
        <div style="text-align: center;">
            <nav style="background: rgba(30, 144, 255, 1); ">
                <ul class="menu" style="display: inline-block;">
                    <li><a onclick="loadExplore()">Esplora</a></li>
                    <li><a onclick="loadMyProfile()">La mia scheda</a></li>
                    <li><a onclick="loadMyQuestion()'">Le mia domande</a></li>
                </ul>
            </nav>
        </div>
        <div id="page"></div>
    </body>
<html>
