<?php
    $matter = $_GET['matter'];
    $sect = $_GET["sect"];
    include 'model/dbHandler.php';
    $dbhandler = new DbHandler();
    if(!isset($_GET["search"])){
        $questions = $dbhandler->getQuestionsFromMatter($matter, $sect);
    }else{
        $questions = $dbhandler->getQuestionsStartingWith($matter, $sect, $_GET["search"]);
    }
    foreach($questions as &$question):
    ?>
<div class="card" style="width: 100%;">
    <div class="card-body">
       <h5 class="card-title" style="color:red;"><?php echo $question[0]?></h5>
       <p class="card-text" style="color:black"><?php echo $question[1]?></p>
       <p class="card-text" style="color:black"><?php echo $question[2]?></p>
       <a onclick="loadQuestion('<?php echo $question[3]?>')" class="btn btn-primary" style = "background:#1e90ff">visualizza</a>
    </div>
</div>
<br>
    <?php endforeach; ?>
