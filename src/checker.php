<?php
    include 'model/dbHandler.php';
    $field = $_GET['field'];
    $value = $_GET['value'];
    $dbchecker = new DbHandler();
    if($dbchecker->usersExists($field, $value)){echo 'true';}    
