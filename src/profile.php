<?php
    include 'model/dbHandler.php';
    
    $dbhandler = new DbHandler();
    $user = $dbhandler->getUser($_GET["username"]);
    $name = $user["name"];
    $surname = $user["surname"];
    $email = $user["email"];
    $class = $user["class"];
?>
<?php echo "<?xml version='1.0' encoding='UTF-8'?>";?>
<user>
    <name><?php echo $name;?></name>
    <surname><?php echo $surname;?></surname>
    <email><?php echo $email;?></email>
    <class><?php echo $class;?></class>
</user>