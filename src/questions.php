<?php
    $matter = $_GET['matter'];
    $sect = $_GET["sect"];
    include 'model/dbHandler.php';
    $dbhandler = new DbHandler();
    
    $questions = $dbhandler->getQuestionsFromMatter($matter, $sect);
    foreach($questions as &$question):
    ?>
<div class="card" style="width: 100%;">
    <div class="card-body">
       <h5 class="card-title" style="color:black"><?php echo $question[0]?></h5>
       <p class="card-text" style="color:black"><?php echo $question[1]?></p>
       <p class="card-text" style="color:black"><?php echo $question[2]?></p>
       <a href="question.php?id=<?php echo $question[3]?>" class="btn btn-primary" style = "background:#1e90ff">visualizza</a>
    </div>
</div>
<br>
    <?php endforeach; ?>

