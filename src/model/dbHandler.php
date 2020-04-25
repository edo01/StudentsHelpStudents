<?php

class DbHandler{

    //we need to change this	
    private $username = "studente";
    private $password = "studente";
    private $database = "progetto";
    private $host = "localhost";

    private function connect(){
        $mysqli = new msqli(DbHandler::$host, DbHandler::$username,
                DbHandler::$password, DbHandler::$database);
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
        $insertion = "INSERT INTO Users(name, surname, username, email, class, password)"
                . " VALUES ($name, $surname, $username, $email, $class, $password)";
        if(!$mysqli->query($insertion)){
            print("Error: impossible adding the new user");
        }
        DbHandler::close($mysqli);
    }

    function insertQuestion($title, $description, $subject, $section, $username, $ID_answer){
        $mysqli = DbHandler::connect();
        $insertion = "INSERT INTO Questions(title, description, subject, section, username, ID_answer)"
                . " VALUES ($title, $description, $subject, $section, $username, $ID_answer)";
        if(!$mysqli->query($insertion)){
            print("Error: impossible adding new question");
        }
        DbHandler::close($mysqli);
    }

    function insertAnswer( $description, $ID_question, $username){
        $mysqli = DbHandler::connect();
        $insertion = "INSERT INTO Answers( description, ID_question,username)"
                . " VALUES ($description, $ID_question, $username)";
        if(!$mysqli->query($insertion)){
            print("Error: impossible adding new answer");
        }
        DbHandler::close($mysqli);
    }

    //take a look here
    function insertFile($content, $extention, $ID_answer, $ID_question){
        $mysqli = DbHandler::connect();
        $insertion = "INSERT INTO Files(content, extention, ID_answer, ID_question)"
                . " VALUES ($content, $extention, $ID_answer, $ID_question)";
        if(!$mysqli->query($insertion)){
            print("Error: impossible adding new file");
        }
        DbHandler::close($mysqli);
    }

    function login($username, $password){
	$mysqli = DbHandler::connect();
	$password = password_hash($password, PASSWORD_DEFAULT);
        $insertion = "SELECT * FROM Users WHERE ID_impiegato = '$username' AND"
                . " password = '$password';";
	if(mysql_num_rows($result1) > 0){
	        return true;
	}else{
	     	return false;
	}

        if(!$mysqli->query($insertion)){
            print("Error: impossibile executing this command");
	}
        DbHandler::close($mysqli);
    }
}
?>


