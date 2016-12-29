<?php
define('DBHOST', 'projekt.wi.fh-flensburg.de');
define('DBNAME', 'projekt2016a');
define('DBUSER', 'projekt2016a');
define('DBPASS', 'pkn_2404');


    class DB{
        private $db;
        public function __construct() {
            $this->db = new mysqli(DBHOST,DBUSER,DBPASS,DBNAME);
            mysqli_set_charset($this->db, 'utf8');
        }
        public function close(){
            $this->db->close();
        }
        // user model
        public function checkLogin($username,$password){
            $query = "SELECT * FROM Person WHERE Username ='".$username."' AND Password ='".$password."'";
            if($this->db->query($query)->num_rows > 0){
                return true;
            }
            else{
                return false;
            }
        }
        public function checkEmail($email){
            $query = "SELECT * FROM Person where Email ='".$email."'";
            if($this->db->query($query)->num_rows > 0){
                return true;
            }
            else{
                return false;
            }
        }
        public function resetPassword($email,$newPassword){
            $query = "UPDATE Person SET Password = '".$newPassword."' WHERE Email ='".$email."'";
            if($this->db->query($query) == TRUE){
                return true;
            }
            else{
                return false;
            }          
        }
        // registration model
        public function insertRegistration($data){
            $query = "INSERT INTO Person (Title,FirstName,LastName,Username,Password,Email,IsValidated) "
                    ."VALUES('"
                    .$data->Title."','"
                    .$data->FirstName."','"
                    .$data->LastName."','"
                    .$data->Username."','"
                    .$data->Password."','"
                    .$data->Email."','"
                    .$data->IsValidated
                    ."')";
            if($this->db->query($query) == TRUE){
                return true;
            }
            else{
                return false;
            }                
        }
        public function getQuestion($questionID){
            require_once 'models/questions.php';
            $query = "SELECT QuestionID, Text, SelectionType, Time FROM Question WHERE QuestionID =".$questionID;
            $result = $this->db->query($query);
            $question = new questions();
            if($result->num_rows >0){
                while($row = $result->fetch_assoc()){
                    $question->QuestionID = $row['QuestionID'];
                    $question->Text = $row['Text'];
                    $question->SelectionType = $row['SelectionType'];
                    $question->Time = $row['Time'];
                }
                return $question;
            }
            else{
                return -1;
            }           
        }
        public function getAnswers($questionID){
            require_once 'models/answers.php';
            $answers = array();
            $query = "SELECT AnswerID, Text, Question, IsRight, Author FROM Answer WHERE Question ='".$questionID."'";
            $result = $this->db->query($query);
            if($result->num_rows >0){
                $count = 0;
                while($row = $result->fetch_assoc()){
                    $answer = new answers();
                    $answer->AnswerID = $row['AnswerID'];
                    $answer->Text = $row['Text'];
                    $answer->Question = $row['Question'];
                    $answer->IsRight = $row['IsRight'];
                    $answer->Author = $row['Author'];
                    $answers[$count++] = $answer;
                }
                return $answers;
            }
            else{
                return -1;
            }
        }
        public function getQuestions($userid){
            require_once 'models/questions.php';
            $questions = array();
            $query = "SELECT QuestionID, Text, SelectionType, Time FROM Question WHERE Author ='".$userid."'";
            $result = $this->db->query($query);
            if($result->num_rows >0){
                $count = 0;
                while($row = $result->fetch_assoc()){
                    $question = new questions();
                    $question->QuestionID = $row['QuestionID'];
                    $question->Text = $row['Text'];
                    $question->SelectionType = $row['SelectionType'];
                    $question->Time = $row['Time'];
                    $questions[$count++] = $question;
                }
                return $questions;
            }
            else{
                return -1;
            }
            
        }
        public function getUsers(){
        	require_once 'models/user.php';
        	$persons = array();
        	$query = "SELECT Username, FirstName, LastName, Email, IsValidated FROM Person;";
        	$result = $this->db->query($query);
        	if($result ->num_rows >0){
        		$count = 0;
        		while($row = $result->fetch_row()){
        			$person = new user(row[0]);
        			$person->firstName = $row[1];
        			$person->lastName = $row[2];
        			$person->eMail = $row[3];
        			if ($row[4] == '1'){
        				$person->isValidated = true;
        			}
        			else{
        				$person->isValidated = false;
        			}
        			$persons[$count++] = $person;
        		}
        		return $persons;
        	}
        	else{
        		return -1;
        	}
        }
        public function deleteUser($email){
        	$query = "DELETE FROM Person WHERE Email='$email'";
        	$resultSet = mysqli_query($this->db, $query);
        }
        public function saveQuestion($question){
            require_once 'models/questions.php';
            $query = "INSERT INTO Question(Text,SelectionType,Time,Author)"
                    ."VALUES('"
                    .$question->Text."','"
                    .$question->SelectionType."','"
                    .$question->Time."','"
                    .$question->Author."')";
            if ($this->db->query($query) == TRUE){
                return $this->db->insert_id;
            }
            else{
                return -1;
            }
        }
        public function deleteQuestion($id){
            $query ="DELETE FROM Question WHERE QuestionID =".$id;
            if($this->db->query($query) == TRUE){
                return true;
            }
            else{
                return false;
            }
        }
        public function editQuestion($question){
            //questionmodel - speichern;
            require_once 'models/questions.php';
            $query = "UPDATE Question SET "
                     ."Text = '".$question->Text."', "
                     ."SelectionType = '".$question->SelectionType."', "
                     ."Time = '".$question->Time."'"
                     ." WHERE QuestionID = ".$question->QuestionID;
            if($this->db->query($query) == TRUE){
                return TRUE;
            }
            else{
                return FALSE;
            }             
        }
        public function editAnswer($answer){
            //answermodel - speichern;
            $rightorwrong = 0;
            if($answer->IsRight == TRUE){
                $rightorwrong = 1;
            }
            require_once 'models/answers.php';
            $query = "UPDATE Answer SET "
                     ."Text = '".$answer->Text."', "
                     ."IsRight = ".$rightorwrong
                     ." WHERE AnswerID = ".$answer->AnswerID;
            if($this->db->query($query) == TRUE){
                return TRUE;
            }
            else{
                return FALSE;
            }
        }
        public function saveAnswer($answer){
            require_once 'models/answers.php';
            $query = "INSERT INTO Answer(Text,Question,IsRight,Author)"
                    ."VALUES('"
                    .$answer->Text."','"
                    .$answer->Question."','"
                    .$answer->IsRight."','"
                    .$answer->Author."')";
            if ($this->db->query($query) == TRUE){
                return $this->db->insert_id;
            }
            else{
                return -1;
            }
        }       
    }