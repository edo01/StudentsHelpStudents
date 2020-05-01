<?php
    session_start();
    include 'model/dbHandler.php';
    
    $dbhandler = new DbHandler();
    $user = $dbhandler->getUser($_SESSION["username"])
;    $n_right = $dbhandler->getRightAnswersOfUser($_SESSION["username"]);
    $name = $user["name"];
    $surname = $user["surname"];
    $email = $user["email"];
    $class = $user["class"];
?>
<div class="font-weight-light">
    <div class="container tm-container-max-800" >
        <div class="row">
            <div class="col-12">
                <header class="mt-5 mb-5 text-center">
                    <h1 class="font-weight-light tm-form-title">Ciao <?php echo $name?>,</h1>
                    <h2 class="font-weight-light tm-form-title">questa è la tua scheda personale</h2>
                    <p class="tm-form-description">In questa pagina potrai consultare le tue statistiche.</p>
                </header>     
            </div>
            <div class="col-6">
            <div class="tm-bg-black tm-form-block " style="background-color:rgba(30, 144, 255, 0.5);">
                <div class="row mb-4 ">
                    <div class="col-xl-6">
                        <div class="tm-home-left mt-3 font-weight-light">
                            <p class="tm-mb-35">username:</p>
                        </div>
                        <div class="tm-home-left mt-3 font-weight-light">
                            <p class="tm-mb-35">nome:</p>
                        </div>
                        <div class="tm-home-left mt-3 font-weight-light">
                            <p class="tm-mb-35">cognome:</p>
                        </div>
                        <div class="tm-home-left mt-3 font-weight-light">
                            <p class="tm-mb-35">classe:</p>
                        </div>
                        <div class="tm-home-left mt-3 font-weight-light">
                            <p class="tm-mb-35">email:</p>
                        </div>
                        <div class="tm-home-left mt-3 font-weight-light">
                            <p class="tm-mb-35">risposte giuste:</p>
                        </div>
                    </div>
                 </div>
            </div>
            </div>
            <div class="col-6">
            <div class="tm-bg-black tm-form-block" style="background-color: rgba(30, 144, 255, 0.5);"> 
                <div class="row mb-4">
                    <div class="col-xl-6">
                        <div class="tm-home-left mt-3 font-weight-light">
                            <p class="tm-mb-35"><?php echo $_SESSION["username"];?></p>
                        </div>
                        <div class="tm-home-left mt-3 font-weight-light">
                            <p class="tm-mb-35"><?php echo $name;?></p>
                        </div>
                        <div class="tm-home-left mt-3 font-weight-light">
                            <p class="tm-mb-35"><?php echo $surname;?></p>
                        </div>
                        <div class="tm-home-left mt-3 font-weight-light">
                            <p class="tm-mb-35"><?php echo $class;?></p>
                        </div>
                        <div class="tm-home-left mt-3 font-weight-light">
                            <p class="tm-mb-35"><?php echo $email;?></p>
                        </div>
                        <div class="tm-home-left mt-3 font-weight-light">
                            <p class="tm-mb-35"><?php echo $n_right;?></p>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <footer class="row tm-mt-big mb-3"></footer>
    </div>

    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/materialize.min.js"></script>
</div>