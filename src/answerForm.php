<?php
    $id = $_GET['id'];
?>
<div style="width:100%;background-color: rgba(30, 144, 255, 0.7);">
    <h5 style="padding:10px;">Rispondi:</h5>
</div> 
<form id="answer-form" action="index.php?newAnswer=true" method="POST">
    <div class="row">
        <div class="col">
            <div class="form-group">
                <textarea class="form-control" placeholder="Scrivi la tua risposta..." id="answer_aerea" name="answer" required rows="10"></textarea>
                 <input type="hidden" name="ID_question" value="<?php echo $id;?>">
            </div>
            
        </div>
        <div class="form-group">
                <div style="width:100%;background-color: rgba(30, 144, 255, 0.7);">
                    <h5 style="padding:10px;">Carica un file:</h5>
                    <input type="file"  class="form-control-file float-right" id="file-loader" name="file">
                </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <a onclick="document.getElementById('answer-form').submit()" class="btn btn-primary float-right" style = "background:#ff0000">Invia risposta</a>
        </div>
    </div>
</form>