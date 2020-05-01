<?php
    $id = $_GET['id'];
?>
<form id="answer-form" action="index.php?newAnswer=true" method="POST">
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="answer_aerea">Scrivi qui la tua risposta</label>
                <textarea class="form-control" placeholder="Scrivi la tua risposta..." id="answer_aerea" name="answer" required rows="10"></textarea>
                 <input type="hidden" name="ID_question" value="<?php echo $id;?>">

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <a onclick="document.getElementById('answer-form').submit()" class="btn btn-primary float-right" style = "background:#ff0000">Invia risposta</a>
        </div>
    </div>
</form>