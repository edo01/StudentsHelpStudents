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

/**
 *                  DbHandler.php
 * THIS PAGE IS USED TO HANDLE THE DATABASE.
 */
class DbHandler{
    
    /**
     * Open the connection with the database
     * @return mysqli 
     */
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

    /**
     * Closes the connection
     * @param type $mysqli
     */
    private function close($mysqli){
        $mysqli->close();
    }

    /**
     * Insert a new user inside the database
     * @param string $name
     * @param string $surname
     * @param string $username
     * @param string $email
     * @param string $class
     * @param string $password
     * @return boolean
     */
    function insertNewUser($name, $surname, $username, $email, $class, $password){
	$mysqli = DbHandler::connect();
        $name = $mysqli->real_escape_string($name);
        $surname = $mysqli->real_escape_string($surname);
        $email = $mysqli->real_escape_string($email);
        $class = $mysqli->real_escape_string($class);
        $username = $mysqli->real_escape_string($username);
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

    /**
     * Insert a new question inside the database.
     * @param string $title
     * @param string $description
     * @param string $matter
     * @param string $section
     * @param string $username
     */
    function insertQuestion($title, $description, $matter, $section, $username){
        $mysqli = DbHandler::connect();
        $title = $mysqli->real_escape_string($title);
        $matter = $mysqli->real_escape_string($matter);
        $section = $mysqli->real_escape_string($section);
        $description = $mysqli->real_escape_string($description);
        $username = $mysqli->real_escape_string($username);
        $insertion = "INSERT INTO Questions(title, description, name, sect, username, date_time)"
                . " VALUES ('$title', '$description', '$matter', '$section', '$username', NOW())";
        if(!$mysqli->query($insertion)){
            print("Error: impossible adding new question:".$mysqli->error);
        }
        DbHandler::close($mysqli);
    }

    /**
     * Insert an answer inside the database.
     * @param string $description
     * @param int $ID_question
     * @param string $username
     */
    function insertAnswer($description, $ID_question, $username){
        $mysqli = DbHandler::connect();
        $ID_question = $mysqli->real_escape_string($ID_question);
        $description = $mysqli->real_escape_string($description);
        $username = $mysqli->real_escape_string($username);
        $insertion = "INSERT INTO Answers( description, correct, ID_question, username, date_time)"
                . " VALUES ('$description', false, '$ID_question', '$username', NOW())";
        if(!$mysqli->query($insertion)){
            print("Error: impossible adding new answer");
        }
        DbHandler::close($mysqli);
    }

    /**
     * Insert a file inside the database.
     * @param string $content
     * @param string $extention
     * @param int $ID_answer
     * @param int $ID_question
     */
    function insertFile($content, $extention, $ID_answer, $ID_question){
        $mysqli = DbHandler::connect();
        $insertion = "INSERT INTO Files(content, extention, ID_answer, ID_question)"
                . " VALUES ('$content', '$extention', '$ID_answer', '$ID_question')";
        if(!$mysqli->query($insertion)){
            print("Error: impossible adding new file");
        }
        DbHandler::close($mysqli);
    }

    /**
     * Controls if the username and the password are correct.
     * @param string $username
     * @param string $password
     * @return boolean if the username and the password are correct
     */
    function login($username, $password){
	$mysqli = DbHandler::connect();
        $username = $mysqli->real_escape_string($username);
        $insertion = "SELECT password FROM Users WHERE username = '$username'";
        $result = $mysqli->query($insertion);
	$hash = $result->fetch_array(MYSQLI_NUM);
        if(!$result){
            print("Error: impossibile executing this command");
	}
        DbHandler::close($mysqli);
        if(password_verify($password, $hash[0])){
            return true;
        }else{ return false;}
    }
    
    /**
     * Controls if the users already exits.
     * @param string $field (can be 'email' or 'username')
     * @param string $value
     * @return boolean if the user exists
     */
    function usersExists($field, $value){
        $mysqli = DbHandler::connect();
        $field = $mysqli->real_escape_string($field);
        $value = $mysqli->real_escape_string($value);
        //hashing the password in order to don't be hacked
        $insertion = "SELECT username FROM Users WHERE $field = '$value'";
        $result = $mysqli->query($insertion);
	$n = $result->num_rows;
        if(!$result){
            print("Error: impossibile executing this command");
	}
        DbHandler::close($mysqli);
        if($n>0){
            return true;
        }else{ return false;}
    }
    
    /**
     * Gets the user by username.
     * @param string $username
     * @return assoc_array user
     */
    function getUser($username){
        $mysqli = DbHandler::connect();
        $username = $mysqli->real_escape_string($username);
        $insertion = "SELECT name,surname,email,class FROM Users WHERE username = '$username'";
        
        $result = $mysqli->query($insertion);
        if(!$result){
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
    
    /**
     * Gets all the sections in the db.
     * @return array example:Array ( [0] => Array ( [0] => 5° ) [1] => Array ( [0] => 5° informatica ) ) 
     */
    function getAllSections(){
        $mysqli = DbHandler::connect();
        $insertion = "SELECT sect FROM Matters GROUP BY sect";
        $result = $mysqli->query($insertion);
        if(!$result){
            print("Error: impossibile executing this command:".$mysqli->error);
	}
        DbHandler::close($mysqli);
	$sections = $result->fetch_all(MYSQLI_NUM);
        return $sections;
        
    }
    
    /**
     * Gets all the matters of a given section.
     * @param string $section
     * @return array with the name of the matters
     */
    function getMattersFromSection($section){
        $mysqli = DbHandler::connect();
        $section = $mysqli->real_escape_string($section);
        $insertion = "SELECT name FROM Matters WHERE sect='$section'";
        $result = $mysqli->query($insertion);
        if(!$result){
            print("Error: impossibile executing this command:".$mysqli->error);
	}
        DbHandler::close($mysqli);
	$matters = $result->fetch_all(MYSQLI_NUM);
        return $matters;
    }
    
    /**
     * Gets all the questions of a given section and matter.
     * @param string $matter
     * @param string $sect
     * @return array with the questions
     */
    function getQuestionsFromMatter($matter,$sect){
        $mysqli = DbHandler::connect();
        $matter = $mysqli->real_escape_string($matter);
        $sect = $mysqli->real_escape_string($sect);
        $insertion = "SELECT title,description,date_time,ID_question FROM "
                . "Questions AS q WHERE q.name = '$matter' AND q.sect = '$sect' ORDER BY date_time DESC";
        $result = $mysqli->query($insertion);
        if(!$result){
            print("Error: impossible executing this command:".$mysqli->error);
	}
        DbHandler::close($mysqli);
	$questions = $result->fetch_all(MYSQLI_NUM);
        return $questions;
    }
    
    /**
     * Returns the number of right answer of an user.
     * @param string $username
     * @return int the number of right answer of an user
     */
    function getRightAnswersOfUser($username){
        $mysqli = DbHandler::connect();
        $username = $mysqli->real_escape_string($username);
        $insertion = "SELECT count(ID_answer) as right_answers FROM "
                . "Users AS u,Answers AS a WHERE a.username = '$username' AND correct = true";
        $result = $mysqli->query($insertion);
        if(!$result){
            print("Error: impossible executing this command:".$mysqli->error);
	}
        DbHandler::close($mysqli);
	$n = $result->fetch_assoc();
        return $n["right_answers"];
    }
    
    /**
     * Returns all the answers of a question.
     * @param int $ID_question
     * @return type
     */
    function getAnswersFromQuestion($ID_question){
        $mysqli = DbHandler::connect();
        $ID_question = $mysqli->real_escape_string($ID_question);
        $insertion = "SELECT a.description,correct,a.date_time FROM "
                . "Answers AS a INNER JOIN Questions AS q ON a.ID_question = q.ID_question "
                . "WHERE a.ID_question = '$ID_question' ORDER BY a.date_time DESC";
        $result = $mysqli->query($insertion);
        if(!$result){
            print("Error: impossible executing this command:".$mysqli->error);
	}
        DbHandler::close($mysqli);
	$answers = $result->fetch_all(MYSQLI_NUM);
        return $answers;
    }
    
    /**
     * Gets all the questions with the string "alias" inside.
     * @param string $matter
     * @param string $sect
     * @param string $alias
     * @return array of the questions
     */
    function getQuestionsStartingWith($matter,$sect,$alias){
        $mysqli = DbHandler::connect();
        $matter = $mysqli->real_escape_string($matter);
        $sect = $mysqli->real_escape_string($sect);
        $alias = $mysqli->real_escape_string($alias);
        $username = $mysqli->real_escape_string($username);
        $insertion = "SELECT title,description,date_time,ID_question FROM "
                . "Questions AS q WHERE q.name = '$matter' AND q.sect = '$sect' AND q.title LIKE '%$alias%' ORDER BY date_time DESC";
        $result = $mysqli->query($insertion);
        if(!$result){
            print("Error: impossible executing this command:".$mysqli->error);
	}
        DbHandler::close($mysqli);
	$questions = $result->fetch_all(MYSQLI_NUM);
        return $questions;
    }
    
    /**
     * Gives the question with the given.
     * @param int $id
     * @return array_assoc with the camps of the question
     */
    function getQuestionsById($id){
        $mysqli = DbHandler::connect();
        $id = $mysqli->real_escape_string($id);
        $insertion = "SELECT title,description,date_time FROM "
                . "Questions AS q WHERE q.ID_question = '$id'";
        $result = $mysqli->query($insertion);
        if(!$result){
            print("Error: impossible executing this command:".$mysqli->error);
	}
        DbHandler::close($mysqli);
	$question = $result->fetch_assoc();
        return $question;
    }
    
    /**
     * Gets all the question of an user.
     * @param string $username
     * @return array of the questions
     */
    function getQuestionsByUser($username){
        $mysqli = DbHandler::connect();
        $username = $mysqli->real_escape_string($username);
        $insertion = "SELECT title,description,date_time,ID_question, name, sect FROM "
                . "Questions AS q WHERE username = '$username' ORDER BY date_time DESC";
        $result = $mysqli->query($insertion);
        if(!$result){
            print("Error: impossible executing this command:".$mysqli->error);
	}
        DbHandler::close($mysqli);
	$questions = $result->fetch_all(MYSQLI_NUM); 
        return $questions;
    }
    
    /**
     * Remove a question.
     * @param int $id
     * @return if the question was remove
     */
    function removeQuestion($id){
        $mysqli = DbHandler::connect();
        $id = $mysqli->real_escape_string($id);
        $insertion = "DELETE FROM Questions WHERE ID_question= '$id'";
        $result = $mysqli->query($insertion);
        if(!$result){
            print("Error: impossible executing this command:".$mysqli->error);
	}
        DbHandler::close($mysqli);
        return $result;
    }
}