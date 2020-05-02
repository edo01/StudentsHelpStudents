<!DOCTYPE html>
<?php
    session_start();
    //if the logout has been clicked, destroys the session
    if(isset($_GET["logout"]) && $_GET["logout"]){
        if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == true){
            session_destroy();
        }
    }
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ShS</title>
  
    <link rel="icon" href="favicon.ico">
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="css/tooplate.css">
</head>

<body id="home">
    <div class="container tm-home-mt tm-home-container">
        <div class="row">
            <div class="col-12">
                <div class="tm-home-left">
                    <h1 class="tm-site-title">STUDENTS HELP STUDENTS</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="tm-home-left mt-3 font-weight-light">
                    <p class="tm-mb-35">La piattaforma degli studenti dell'I.I.S. Belluzzi-Fioravanti</p>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <ul class="list-group tm-home-list tm-bg-black font-weight-light">
                    <li class="d-flex justify-content-between align-items-center">
                        <a href="access.php?page=login" class="tm-white-text">Accedi</a>
                    </li>
                    <li class="d-flex justify-content-between align-items-center">
                        <a href="access.php?page=signup" class="tm-white-text">Registrati</a>
                    </li>  
                </ul>
            </div>
        </div>
    </div>
 </body>

</html>