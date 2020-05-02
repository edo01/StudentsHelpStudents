<!DOCTYPE html>
<!--
                                index.php
    This page is the main page of the site. The default page is myProfile, but
    clicking on the navigation bar is possible to load myQuestions page, explore
    page and to log out. 
-->
<?php
	session_start();
        include 'model/dbHandler.php';
        
        //setting default function to call when body is loaded
        $request = 'loadMyProfile()';
        /* if the user copy and paste the link domain/index.php is necessary to
         * redirect him to the home page
         */
	if(!isset($_SESSION['logged_in']) || $_SESSION["logged_in"]== false){
            header("location: home.php");
	}
        //if the newAnswer is set a new answer was insert
        if(isset($_GET["newAnswer"]) && $_GET["newAnswer"]){
            if(isset($_POST["answer"]) && isset($_POST["ID_question"])){
                $answer = $_POST["answer"];
                $id = $_POST["ID_question"];
                $dbHandler = new DbHandler();
                $dbHandler->insertAnswer($answer, $id, $_SESSION["username"]);
                //returns to the question panel
                $request = "loadQuestion_s('$id')";
            }
        }else if(isset($_GET["newQuestion"]) && $_GET["newQuestion"]){
            //insert the new question
            if(isset($_POST["question-title"]) && isset($_POST["question-description"])){
                $title = $_POST["question-title"];
                $description = $_POST["question-description"];
                $sect = explode('-',$_POST["section-select"])[0];
                $matter = explode('-',$_POST["section-select"])[1];
                $dbHandler = new DbHandler();
                $dbHandler->insertQuestion($title, $description,$matter,$sect, $_SESSION["username"]);
            }
            
            //return to myQuestionPanel
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
        
        <link rel="icon" href="favicon.ico">
        
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
