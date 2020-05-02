<!DOCTYPE html>
<?php
    session_start();
    include 'model/dbHandler.php';
    $dbhandler = new DbHandler();
    //load all the section from the database
    $sections = $dbhandler->getAllSections();
?>
<form id="answer-form" action="index.php?newQuestion=true" method="POST">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <header class="mt-5 mb-5 text-center">
                    <h2 class="font-weight-light tm-form-title">Scrivi una domanda!</h2>
                </header>     
            </div>
            <div class="col" style="margin-top: -30px">
                <div class="form-group">
                    <div class="tm-home-left mt-3 ">
                        <p class="tm-mb-35" style="margin-bottom: 0px">Titolo della domanda(max 255 caratteri):</p>
                        <input type="text" style="color:white;" class="form-control" placeholder="Titolo..." id="questiol-title" name="question-title" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="row">
                    <div class="col-9 form-group">
                        <p class="tm-mb-35" style="margin-bottom: 10px">Testo della domanda:</p>
                        <textarea class="form-control" style = "background:rgba(30, 144, 255, 0.5);color: white;" placeholder="Testo della domanda..." id="question-description" name="question-description" required rows="10"></textarea>
                    </div>
                    <div class="col-3 form-group">
                        <p class="tm-mb-35" style="margin-bottom: 10px">Seleziona la materia</p>
                        <select class="form-control" name="section-select">
<?php
  /* populate the select with the sections
   * and the matters.
   */
  //iterates the results of the array
  foreach ($sections as &$arr) {
      //iterates the section
      foreach($arr as &$section){
          $men = "";
          $matters = $dbhandler->getMattersFromSection($section);
          echo "<optgroup name=\"$section\" label=\"$section\">$men";
          //iterates the matters
          foreach ($matters as &$matter){
              $men .= "<option value='$section-$matter[0]'>$matter[0]</option>";                       
          }
          echo "$men.</optgroup>";  
      }
  }
?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <h5 style="padding:10px;">Carica un file:</h5>
        <div class="row" style="padding-bottom: 40px;">
            <div class="col">
                <input type="file" class="form-control-file float-right" id="file-loader" name="file">
            </div>
            <div class="col float-right" >
                <a onclick="document.getElementById('answer-form').submit()" class="btn btn-primary float-right" style = "background:rgba(30, 144, 255, 0.5)">Carica Domanda</a>
            </div>
        </div>
        <div class="row" style=" width:100%;background-color: rgba(255, 0, 0, 0.5);">
            <div class="col-md-6">
                <h5 style="margin-top: 10px">Le tue domande precedenti:</h5>
            </div>
        </div> 
        <div>
<?php
    $questions = $dbhandler->getQuestionsByUser($_SESSION["username"]);
    //load all the questions of the user
    foreach($questions as &$question):
?>
            <div class="card" style="width: 100%;">
            <div class="card-body">
               <h5 class="card-title" style="color:red;"><?php echo $question[0]?></h5>
               <p class="card-text" style="color:black"><?php echo $question[1]?></p>
               <p class="card-text" style="color:black"><?php echo $question[2]?></p>
               <a onclick="loadQuestion_s('<?php echo $question[3]?>')" class="btn btn-primary" style = "background:#1e90ff">visualizza</a>
            </div>
            </div>
            <br>
<?php endforeach; ?>
        </div>
    </div>
</form>