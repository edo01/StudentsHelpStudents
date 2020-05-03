<!DOCTYPE html>
<?php
    include 'model/dbHandler.php';
    $dbhandler = new DbHandler();
    //load all the section from the database
    $sections = $dbhandler->getAllSections();
?>    
<input type="checkbox" id="nav-toggle" hidden>
<nav class="nav">
    <label for="nav-toggle" class="nav-toggle" onclick></label>
    <h2 class="logo"> 
        <a>Scegli l'argomento</a> 
    </h2>
    <ul id="sections">
        <?php
            //loading the sections and the matters into the navigation bar
            foreach ($sections as &$arr) {
                foreach($arr as &$section){
                    $men = "";
                    $matters = $dbhandler->getMattersFromSection($section);
                    foreach ($matters as &$arr2){
                        $men .= "<li><a onclick=\"loadQuestions('$arr2[0]','$section')\""
                                . " class='matters'>$arr2[0]</a></li>";                       
                    }
                    echo "<h3 class='section'>$section</h3></li>$men";    
                }
            }
        ?>
    </ul>
</nav>
<div class="container">
    <div class="search_bar input-field" id="src-bar-exp" style="text-align:center;margin-top:10px;">
        <input type="text" oninput="searchQuestions(this)" style="padding:5px;width:80%; color: white;" placeholder="Cerca..">
    </div>
    <div id="questions_box">

    </div>
</div>