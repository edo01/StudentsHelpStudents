<?php
	session_start();
        include 'model/dbHandler.php';
        $request = 'loadMyProfile()';
	if(!isset($_SESSION['logged_in']) || $_SESSION["logged_in"]== false){
	header("location: home.php");
	}
        if(isset($_GET["newAnswer"]) && $_GET["newAnswer"]){
            $answer = $_POST["answer"];
            $id = $_POST["ID_question"];
            $dbHandler = new DbHandler();
            $dbHandler->insertAnswer($answer, $id, $_SESSION["username"]);
            $request = "loadQuestion_s('$id')";
        }
        else if(isset($_GET["newQuestion"]) && $_GET["newQuestion"]){
            $title = $_POST["question-title"];
            $description = $_POST["question-description"];
            $sect = explode('-',$_POST["section-select"])[0];
            $matter = explode('-',$_POST["section-select"])[1];
            $dbHandler = new DbHandler();
            $dbHandler->insertQuestion($title, $description,$matter,$sect, $_SESSION["username"]);
            $request = "loadMyQuestions()";
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
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body onload="<?php echo $request ?>" id="profile">
        <div style="text-align: center;">
            <nav style="background: rgba(30, 144, 255, 1); ">
                <ul class="menu" style="display: inline-block;">
                    <li><a onclick="loadExplore()">Esplora</a></li>
                    <li><a onclick="loadMyQuestions()">Le mie domande</a></li>
                    <li><a onclick="loadMyProfile()">La mia scheda</a></li>
                    <li><a onclick="loadClassification()">Classifica</a></li>
                    <li><a href="home.php?logout=True">logout</a></li>
                </ul>
            </nav>
        </div>
        <div id="page"></div>
    </body>
<html>
