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
            $query = "SELECT QuestionID, Text, SelectionType, Time, Author FROM Question WHERE QuestionID =".$questionID;
            $result = $this->db->query($query);
            $question = new questions();
            if($result->num_rows >0){
                while($row = $result->fetch_assoc()){
                    $question->QuestionID = $row['QuestionID'];
                    $question->Text = $row['Text'];
                    $question->SelectionType = $row['SelectionType'];
                    $question->Time = $row['Time'];
                    $question->Author = $row['Author'];
                }
                return $question;
            }
            else{
                echo -1;
                //return -1;
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
        	$query = "SELECT Username, FirstName, LastName, Email, IsValidated, IsAdmin FROM Person;";
        	$result = $this->db->query($query);
        	if($result ->num_rows >0){
        		$count = 0;
        		while($row = $result->fetch_row()){
        			$person = new user($row[0]);
        			$person->firstName = $row[1];
        			$person->lastName = $row[2];
        			$person->eMail = $row[3];
        			if ($row[4] == '1'){
        				$person->isValidated = true;
        			}
        			else{
        				$person->isValidated = false;
        			}
        			$person->isAdmin = $row[5];
        			$persons[$count++] = $person;
        		}
        		return $persons;
        	}
        	else{
        		return -1;
        	}
        }
        public function deleteUser($id){
        	$query = "DELETE FROM Person WHERE PersonID ='$id'";
        	if (mysqli_query($this->db, $query) == TRUE){
        		return true;
        	}
        	else{
        		return false;
        	}        		
        }       
        public function validateUser($id){        	
        	$query = "UPDATE Person SET IsValidated = IF(IsValidated=1,0,1) WHERE PersonID='$id'";
        	if (mysqli_query($this->db, $query) == TRUE){
        		return $this->getUserID($id);
        	}
        	else{
        		return false;
        	}
        }
        private function getUserID($id){
        	$query = "SELECT IsValidated FROM Person WHERE PersonID='$id'";  
        	
        	$result = mysqli_query($this->db, $query);        	
        	$row = mysqli_fetch_array($result);
        	
        	return $row['IsValidated'];    	
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
        public function getQuestionairy($questionairyid){
            require_once 'models/questionairy.php';
            $query = "SELECT QuestionairyID, Author, Title, Description, DateOfCreation, Course FROM Questionairy WHERE QuestionairyID = ".$questionairyid;
            $result = $this->db->query($query);
            if($result->num_rows >0){
                while($row = $result->fetch_assoc()){
                    $questionairy = new questionairy();
                    $questionairy->QuestionairyID = $row['QuestionairyID'];
                    $questionairy->Author = $row['Author'];
                    $questionairy->Title = $row['Title'];
                    $questionairy->Description = $row['Description'];
                    $questionairy->DateOfCreation = $row['DateOfCreation'];
                    $questionairy->Course = $row['Course'];
                }
                return $questionairy;
            }
            else{
                return -1;
            }
        }
        public function getQuestionairyQuestion($id){
            require_once 'models/questionairy.php';
            require_once 'models/questions.php';
            $query = "SELECT Question FROM QuestionairyQuestions WHERE Questionairy = ".$id;
            $result = $this->db->query($query);
            $output = array();
            $count = 0;
            if($result->num_rows >0){
                while($row = $result->fetch_assoc()){
                    $output[$count++] = $this->getQuestion($row['Question']);
                }
                return $output;
            }
            else{
                return -1;
            }
        }
        public function getOutQuestionairyQuestion($QuestionairyID, $authorID){
            require_once 'models/questionairy.php';
            require_once 'models/questions.php';
            $query = "SELECT QuestionID FROM Question WHERE Question.Author =".$authorID." AND Question.QuestionID NOT IN (
                SELECT Question
                from QuestionairyQuestions
                WHERE Questionairy = ".$QuestionairyID.")";
            $result = $this->db->query($query);
            $output = array();
            $count = 0;
            if($result->num_rows >0){
                while($row = $result->fetch_assoc()){
                    $output[$count++] = $this->getQuestion($row['QuestionID']);
                }
                return $output;
            }
            else{
                return -1;
            }
        }
        public function deleteQuestionairy($questionairyid){
            $query = "DELETE FROM Questionairy WHERE QuestionairyID = ".$questionairyid;
            if($this->db->query($query) == true){
                return true;
            }
            else{
                return -1;
            }
        }
        public function getQuestionairies($userid){
            require_once 'models/questionairy.php';
            $query = "SELECT QuestionairyID, Author, Title, Description, DateOfCreation, Course FROM Questionairy WHERE Author = ".$userid;
            $result = $this->db->query($query);
            if($result->num_rows >0){
                $count = 0;
                while($row = $result->fetch_assoc()){
                    $questionairy = new questionairy();
                    $questionairy->QuestionairyID = $row['QuestionairyID'];
                    $questionairy->Author = $row['Author'];
                    $questionairy->Title = $row['Title'];
                    $questionairy->Description = $row['Description'];
                    $questionairy->DateOfCreation = $row['DateOfCreation'];
                    $questionairy->Course = $row['Course'];
                    $output[$count++] = $questionairy;
                }
                return $output;
            }
            else{
                return -1;
            }
        }
        public function saveQuestionaire($data){
            require_once 'models/questionairy.php';
            $query = "INSERT INTO Questionairy(Author,Title,Course,Description)"
            ."VALUES("        
            .$data->Author.",'"
            .$data->Title."',"
            .$data->Course.", '"
            .$data->Description
             ."')";
            if($this->db->query($query) == TRUE){
                return $this->db->insert_id;
            }
            else{
                return -1;
            }
        }
        public function saveQuestionairyQuestion($questionairyID, $questionID){
            $query ="INSERT INTO QuestionairyQuestions (Questionairy,Question) "
                    ."VALUES("
                    .$questionairyID.", "
                    .$questionID
                    .")";
            if($this->db->query($query) == TRUE){
                return TRUE;
            }
            else{
                return -1;
            }
        }
        public function removeQuestionairyQuestion($questionairyID, $questionID){
            $query = 'DELETE FROM QuestionairyQuestions WHERE Questionairy = '.$questionairyID.' AND Question = '.$questionID;
            if($this->db->query($query) == true){
                return TRUE;
            }
            else{
                return -1;
            }
        }
        public function getCourses($authorID){
                require_once 'models/course.php';
            $query = "SELECT CourseID, Text, Shortcut, Author FROM Course WHERE Author = ".$authorID;
            $output = array();
            $count = 0;
            $result = $this->db->query($query);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                $course = new course();
                $course->CourseID = $row['CourseID'];
                $course->Text = $row['Text'];
                $course->Shortcut = $row['Shortcut'];
                $course->Author = $row['Author'];
                $output[$count++] = $course;
                }
                return $output;
            }
            else{
                return -1;
            }
        }
        public function addCourse($model){
            require_once 'models/course.php';
            $query = 'INSERT INTO Course (Text, Shortcut, Author) VALUES ("'
                    .$model->Text.'", "'
                    .$model->Shortcut.'",'
                    .$model->Author.')';
            if($this->db->query($query) == TRUE){
                return $this->db->insert_id;
            }
            else{
                return -1;
            }
        }
        public function deleteCourse($id){
            $query = "DELETE FROM Course WHERE CourseID = ".$id;
            if($this->db->query($query)){
                return true;
            }   
            else{
                return $query;
            }
        }
        public function editCourse($course){
            require_once 'models/course.php';
            $query = 'UPDATE Course SET Text = "'.$course->Text. '", Shortcut = "'.$course->Shortcut.'" WHERE CourseID = '.$course->CourseID;
            if($this->db->query($query)){
                return true;
            }
            else{
                return -1;
            }
        }
        public function getCourse($id){
            require_once 'models/course.php';
            $query = "SELECT CourseID, Text, Shortcut, Author FROM Course WHERE CourseID = ".$id;
            $result = $this->db->query($query);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                $course = new course();
                $course->CourseID = $row['CourseID'];
                $course->Text = $row['Text'];
                $course->Shortcut = $row['Shortcut'];
                $course->Author = $row['Author'];
                }
                return $course;
            }
            else{
                return -1;
            }
        }
    }
