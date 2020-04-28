<?php
/*
 * this file isn't included inside the repository. It corresponds to the local
 * configuration of your database. The structure of the file is the following:
 * $GLOBALS["local_username"] = "yourusername";
 * $GLOBALS["local_password"] = "yourpassword";
 * $GLOBALS["local_database"] = "yourdatabase";
 * $GLOBALS["local_host"] = "yourhost"; 
 */
include 'local.php';

class DbHandler{
    
    
    function connect(){
        
        /*$username = strval($GLOBALS["local_username"]);
        $password = strval($GLOBALS["local_password"]);
        $database = strval($GLOBALS["local_database"]);
        $host = strval($GLOBALS["local_host"]);
        $mysqli = new msqli($host, $username, $password, $database);*/
        $mysqli = new mysqli("localhost:3306","ShS","ShS_password","ShS");
        if($mysqli->connect_error){  
            print("Connection error:" . $mysqli->connect_error);
            return;
        }
        return $mysqli;
    }

    private function close($mysqli){
        $mysqli->close();
    }

    function insertNewUser($name, $surname, $username, $email, $class, $password){
	$mysqli = DbHandler::connect();
	$password = password_hash($password, PASSWORD_DEFAULT);
        $insertion = "INSERT INTO Users(username, name, surname, email, class, password)"
                . " VALUES ('$username', '$name', '$surname', '$email','$class', '$password')";
        echo $insertion;
        if(!$mysqli->query($insertion)){
            print("Error: impossible adding new user:".$mysqli->error);
            return false;
        }
        DbHandler::close($mysqli);
        return true;
    }

    function insertQuestion($title, $description, $matter, $section, $username, $ID_answer){
        $mysqli = DbHandler::connect();
        $insertion = "INSERT INTO Questions(title, description, matter, section, username, ID_answer)"
                . " VALUES ('$title', '$description', '$matter', '$section', '$username', '$ID_answer')";
        if(!$mysqli->query($insertion)){
            print("Error: impossible adding new question");
        }
        DbHandler::close($mysqli);
    }

    function insertAnswer( $description, $ID_question, $username){
        $mysqli = DbHandler::connect();
        $insertion = "INSERT INTO Answers( description, ID_question,username)"
                . " VALUES ('$description', '$ID_question', '$username')";
        if(!$mysqli->query($insertion)){
            print("Error: impossible adding new answer");
        }
        DbHandler::close($mysqli);
    }

    //take a look here
    function insertFile($content, $extention, $ID_answer, $ID_question){
        $mysqli = DbHandler::connect();
        $insertion = "INSERT INTO Files(content, extention, ID_answer, ID_question)"
                . " VALUES ('$content', '$extention', '$ID_answer', '$ID_question')";
        if(!$mysqli->query($insertion)){
            print("Error: impossible adding new file");
        }
        DbHandler::close($mysqli);
    }

    function login($username, $password){
	$mysqli = DbHandler::connect();
        //hashing the password in order to don't be hacked
        $insertion = "SELECT password FROM Users WHERE username = '$username'";
        $result = $mysqli->query($insertion);
	$hash = $result->fetch_array(MYSQLI_NUM);
        if(!$mysqli->query($insertion)){
            print("Error: impossibile executing this command");
	}
        DbHandler::close($mysqli);
        if(password_verify($password, $hash[0])){
            return true;
        }else return false;
    }
}
?>


