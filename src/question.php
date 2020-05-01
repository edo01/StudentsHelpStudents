<?php
    $id = $_GET['id'];
    include 'model/dbHandler.php';
    $dbhandler = new DbHandler();
    $question = $dbhandler->getQuestionsById($id);
    //attention!! you are assuming that the question exists
    ?>
<div class="container" style="padding:5px">
    <div class="row" style=" border-top: 5px;width:100%;background-color: rgba(255, 0, 0, 0.5);">
        <div class="col-md-6">
            <h5 style="margin-top: 10px">Domanda:</h5>
        </div>
        <div class="col-md-6" style="padding:10px;">
            <a id="answer-btn" onclick="loadAnswerForm('<?php echo $id?>')" class="btn btn-primary float-right" style = "background:#ff0000">rispondi</a>
        </div>
    </div> 
    <div class="card" style="width: 100%; ">
        <div class="card-body">
           <h5 class="card-title" style="color:red;"><?php echo $question["title"];?></h5>
           <p class="card-text" style="color:black"><?php echo $question["description"];?></p>
           <p class="card-text" style="color:black"><?php echo $question["date_time"];?></p>
        </div>
    </div>
    <div id="answer_panel">
    <?php
    $answers = $dbhandler->getAnswersFromQuestion($id);
    ?>
        <div style="width:100%;background-color: rgba(30, 144, 255, 0.7);">
            <h5 style="padding:10px;"><?php echo count($answers)?> risposte:</h5>
        </div> 
   <?php
    foreach($answers as &$answer):
    ?>
        <div class="card" style="width: 100%;">
            <div class="card-body">
               <h5 class="card-title" style="color:black"><?php echo $answer[0];?></h5>
               <p class="card-text" style="color:black"><?php echo $answer[2];?></p>       
            </div>
        </div>
<br>
    <?php endforeach; ?>

    </div>
</div>