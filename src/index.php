<?php
	session_start();
	if(!isset($_SESSION['logged_in']) || $_SESSION["logged_in"]== false){
	header("location: login.php");
	}	
?>
<html>
    <head>
        <title>StudentsHelpStudents</title>
        <style></style>
        <script type="text/javascript" src="js/ajaxFunctions.js"></script>

    </head>

    <body>
        <div>
            <nav>
                    <ul class="menu">
                            <li><a onclick="loadEsplore()">Esplora</a></li>
                            <li><a onclick="loadMyProfile('<?php echo $_SESSION["username"]?>')">La mia scheda</a></li>
                            <li><a onclick="loadMyQuestion('<?php echo $_SESSION["username"]?>')'">Le mia domande</a></li>
                    </ul>
            </nav>
        </div>
        <div id="page"></div>
	</body>
<html>
