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
    
    // mysqli_real_escape_string
    function connect(){
        $mysqli = new mysqli($GLOBALS["local_host"],$GLOBALS["local_username"],
                $GLOBALS["local_password"],$GLOBALS["local_database"]);
        $mysqli->set_charset("utf8");
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
        if(!$mysqli->query($insertion)){
            //print("Error: impossible adding new user:".$mysqli->error);
            return false;
        }
        DbHandler::close($mysqli);
        return true;
    }

    /*
     * not updated
     */
    function insertQuestion($title, $description, $matter, $section, $username,$date_time, $ID_answer){
        $mysqli = DbHandler::connect();
        $insertion = "INSERT INTO Questions(title, description, matter, section, username, ID_answer)"
                . " VALUES ('$title', '$description', '$matter', '$section', '$username', '$ID_answer')";
        if(!$mysqli->query($insertion)){
            print("Error: impossible adding new question");
        }
        DbHandler::close($mysqli);
    }

    /*
     * not updated
     */
    function insertAnswer( $description, $ID_question, $username){
        $mysqli = DbHandler::connect();
        $insertion = "INSERT INTO Answers( description, correct, ID_question, username, date_time)"
                . " VALUES ('$description', false, '$ID_question', '$username', NOW())";
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
        }else{ return false;}
    }
    
    function usersExists($field, $value){
        $mysqli = DbHandler::connect();
        //hashing the password in order to don't be hacked
        $insertion = "SELECT username FROM Users WHERE $field = '$value'";
        $result = $mysqli->query($insertion);
	$n = $result->num_rows;
        if(!$mysqli->query($insertion)){
            print("Error: impossibile executing this command");
	}
        DbHandler::close($mysqli);
        if($n>0){
            return true;
        }else{ return false;}
    }
    
    function getUser($username){
        $mysqli = DbHandler::connect();
        //hashing the password in order to don't be hacked
        $insertion = "SELECT name,surname,email,class FROM Users WHERE username = '$username'";
        
        $result = $mysqli->query($insertion);
        if(!$mysqli->query($insertion)){
            print("Error: impossibile executing this command:".$mysqli->error);
	}
        DbHandler::close($mysqli);
	$user = $result->fetch_assoc();
        if($result->num_rows>1){
            //attenzione duplicato
            //return "errore";
        }
        return $user;
    }
    
    function getAllSections(){
        $mysqli = DbHandler::connect();
        //hashing the password in order to don't be hacked
        $insertion = "SELECT sect FROM Matters GROUP BY sect";
        $result = $mysqli->query($insertion);
        if(!$mysqli->query($insertion)){
            print("Error: impossibile executing this command:".$mysqli->error);
	}
        DbHandler::close($mysqli);
	$sections = $result->fetch_all(MYSQLI_NUM);
        return $sections;
    }
    
    function getMattersFromSection($section){
        $mysqli = DbHandler::connect();
        //hashing the password in order to don't be hacked
        $insertion = "SELECT name FROM Matters WHERE sect='$section'";
        $result = $mysqli->query($insertion);
        if(!$mysqli->query($insertion)){
            print("Error: impossibile executing this command:".$mysqli->error);
	}
        DbHandler::close($mysqli);
	$matters = $result->fetch_all(MYSQLI_NUM);
        return $matters;
    }
    
    function getQuestionsFromMatter($matter,$sect){
        $mysqli = DbHandler::connect();
        //hashing the password in order to don't be hacked
        $insertion = "SELECT title,description,date_time,ID_question FROM "
                . "Questions AS q WHERE q.name = '$matter' AND q.sect = '$sect' ORDER BY date_time DESC";
        $result = $mysqli->query($insertion);
        if(!$mysqli->query($insertion)){
            print("Error: impossible executing this command:".$mysqli->error);
	}
        DbHandler::close($mysqli);
	$questions = $result->fetch_all(MYSQLI_NUM);
        return $questions;
    }
    
    function getRightAnswersOfUser($username){
        $mysqli = DbHandler::connect();
        //hashing the password in order to don't be hacked
        $insertion = "SELECT count(ID_answer) as right_answers FROM "
                . "Users AS u,Answers AS a WHERE a.username = '$username' AND correct = true";
        $result = $mysqli->query($insertion);
        if(!$mysqli->query($insertion)){
            print("Error: impossible executing this command:".$mysqli->error);
	}
        DbHandler::close($mysqli);
	$n = $result->fetch_assoc();
        return $n["right_answers"];
    }
    
    function getAnswersFromQuestion($ID_question){
        $mysqli = DbHandler::connect();
        //hashing the password in order to don't be hacked
        $insertion = "SELECT a.description,correct,a.date_time FROM "
                . "Answers AS a INNER JOIN Questions AS q ON a.ID_question = q.ID_question "
                . "WHERE a.ID_question = '$ID_question' ORDER BY a.date_time DESC";
        $result = $mysqli->query($insertion);
        if(!$mysqli->query($insertion)){
            print("Error: impossible executing this command:".$mysqli->error);
	}
        DbHandler::close($mysqli);
	$answers = $result->fetch_all(MYSQLI_NUM);
        return $answers;
    }
    
    function getQuestionsStartingWith($matter,$sect,$alias){
        $mysqli = DbHandler::connect();
        //hashing the password in order to don't be hacked
        $insertion = "SELECT title,description,date_time,ID_question FROM "
                . "Questions AS q WHERE q.name = '$matter' AND q.sect = '$sect' AND q.title LIKE '%$alias%' ORDER BY date_time DESC";
        $result = $mysqli->query($insertion);
        if(!$mysqli->query($insertion)){
            print("Error: impossible executing this command:".$mysqli->error);
	}
        DbHandler::close($mysqli);
	$questions = $result->fetch_all(MYSQLI_NUM);
        return $questions;
    }
    
    function getQuestionsById($id){
        $mysqli = DbHandler::connect();
        //hashing the password in order to don't be hacked
        $insertion = "SELECT title,description,date_time FROM "
                . "Questions AS q WHERE q.ID_question = '$id'";
        $result = $mysqli->query($insertion);
        if(!$mysqli->query($insertion)){
            print("Error: impossible executing this command:".$mysqli->error);
	}
        DbHandler::close($mysqli);
	$question = $result->fetch_assoc();
        return $question;
    }
}