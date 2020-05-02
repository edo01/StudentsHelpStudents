<?php
    include 'model/dbHandler.php';
    $field = $_GET['field'];
    $value = $_GET['value'];
    $dbchecker = new DbHandler();
    //check if the field given already exists in th database
    if($dbchecker->usersExists($field, $value)){echo 'true';}    
