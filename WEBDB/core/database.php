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
        public function getUser($username){
            $model;
            $query = "SELECT * FROM Person WHERE Username = '".$username."'";
            $result = $this->db->query($query);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc())
                {
                    $model = $row;
                }
            }
            return $model;
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
            $query = "SELECT * FROM Person WHERE Email ='".$email."'";
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
        public function validatePassword($password){
        	$query = "SELECT PersonID FROM Person WHERE Password='$password'";
        	$result = mysqli_query($this->db, $query);
        	if ($result->num_rows == 0){
        		return false;
        	}
        	else{
        		return true;
        	}
        }
        public function updatePassword($id, $password){
        	$query = "UPDATE Person SET Password = '$password' WHERE PersonID = '$id'";
        	if(mysqli_query($this->db, $query) == TRUE){
        		return true;
        	}
        	else{
        		return false;
        	}
        }
        public function getEmail($id){
        	$query = "SELECT Email FROM Person WHERE PersonID = '$id'";
        	$result = mysqli_query($this->db, $query);
        	$row = mysqli_fetch_array($result);
        	return $row['Email'];
        }
        public function updateEmail($id, $email){
        	$query = "UPDATE Person SET Email = '$email' WHERE PersonID = '$id'";
        	if(mysqli_query($this->db, $query) == TRUE){
        		return true;
        	}
        	else{
        		return false;
        	}
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
        public function checkStartCode($startCode){
            $query = "SELECT * FROM Survey WHERE SurveyCode = ".$startCode;
            $result = $this->db->query($query);
            if($result->num_rows > 0){
                return true;
            }
            else{
                return false;
            }
        }
        public function createSurvey($survey){
            require_once 'models/survey.php';
            $survey->Endtime = $survey->EndTime->add(new DateInterval('PT' . $survey->Time . 'M'));
            $query = "INSERT INTO Survey(QuestionairyID,TimeStart,TimeEnd,SurveyCode,Person)"
                    ."VALUES('"
                    .$survey->QuestionairyID."','"
                    .$survey->StartTime->format('Y-m-d H:i:s')."','"
                    .$survey->EndTime->format('Y-m-d H:i:s')."','"
                    .$survey->StartCode."','"
                    .$survey->PersonID."')";
            if ($this->db->query($query) == TRUE){
                return $this->db->insert_id;
            }
            else{
                return -1;
            }
        }
        public function getSurvey($surveyID){
            require_once 'models/survey.php';
            $query = "SELECT SurveyID,QuestionairyID,TimeStart,TimeEnd,SurveyCode,Person FROM Survey WHERE SurveyID =".$surveyID;
            $result = $this->db->query($query);
            if($result->num_rows > 0){
                $model = new survey();
                while($row = $result->fetch_assoc()){
                    $model->SurveyID = $row['SurveyID'];
                    $model->QuestionairyID = $row['QuestionairyID'];
                    $model->StartTime = $row['TimeStart'];
                    $model->EndTime = new DateTime($row['TimeEnd']);
                    $model->StartCode = $row['SurveyCode'];
                    $model->PersonID = $row['Person'];
                }
                return $model;
            }
            else{
                return -1;
            }
        }
        public function getSurveys($userID){
            require_once 'models/survey.php';
            require_once 'models/questionairy.php';
            $output = array();
            $query = "SELECT SurveyID,QuestionairyID,TimeStart,TimeEnd,SurveyCode FROM Survey WHERE Person =".$userID;
            $result = $this->db->query($query);
            if($result->num_rows > 0){
                $i = 0;
                while($row = $result->fetch_assoc()){
                    $questionairy = $this->getQuestionairy($row['QuestionairyID']);
                    $attendence = $this->getSurveyAttendences($row['SurveyID']);
                    $output[$i]['Survey'] = $row;
                    $output[$i]['Questionairy'] = $questionairy;
                    $output[$i]['Attendence'] = $attendence;
                    $i++;
                }
            }
            return $output;
        }
        public function getSurveyAttendences($surveyID){
            $output = 0;
            $query = "SELECT COUNT(DISTINCT(UserID)) as Count FROM Result WHERE SurveyID =".$surveyID;
            $result = $this->db->query($query);
            while($row = $result->fetch_assoc()){
                $output = $row['Count'];
            }
            return $output;
        }
        public function getAttendencesQuestions($surveyID, $questionID){
        	$output = 0;
        	$query = "SELECT COUNT(DISTINCT(UserID)) as Count FROM Result WHERE SurveyID ='".$surveyID."' and QuestionID ='".$questionID."'";
        	$result = $this->db->query($query);
        	while($row = $result->fetch_assoc()){
        		$output = $row['Count'];
        	}
        	return $output;
        }
        public function getSurveyByCode($surveyCode){   
            require_once 'models/survey.php';
            $query = "SELECT SurveyID,QuestionairyID,TimeStart,TimeEnd,SurveyCode,Person FROM Survey WHERE SurveyCode =".$surveyCode;
            $result = $this->db->query($query);
            if($result->num_rows > 0){
                $model = new survey();
                while($row = $result->fetch_assoc()){
                    $model->SurveyID = $row['SurveyID'];
                    $model->QuestionairyID = $row['QuestionairyID'];
                    $model->StartTime = $row['TimeStart'];
                    $model->EndTime = new DateTime($row['TimeEnd']);
                    $model->StartCode = $row['SurveyCode'];
                    $model->PersonID = $row['Person'];
                }
                return $model;
            }
        }
        public function saveSurveyFreeAnswer($sID, $quesID, $answer, $userID){
            $query = 'INSERT INTO Result (SurveyID, QuestionID, Answers, UserID) VALUES('.
                     $sID.','.
                     $quesID.',"'.
                     $answer.'",'.
                     $userID.'")'; 
            $this->db->query($query);
        }
        public function saveSurveyAnswer($sID, $qID, $aID, $userID){
            $query = 'INSERT INTO Result (SurveyID, QuestionID, AnswerID, UserID) VALUES('.
                     $sID.','.
                     $qID.','.
                     $aID.','.
                     $userID.')'; 
            $this->db->query($query);            
        }
        public function getResultAnswers($surveyID) {
        	$answer = null;
        	

        	//$db = new mysqli('projekt.wi.fh-flensburg.de','projekt2016a','pkn_2404','projekt2016a','3306');
        	 
        	$query = "SELECT QuestionairyID FROM Survey where SurveyID = '".$surveyID."'";
        	$questionairyResult = mysqli_query($this->db, $query);
        	$questionairyRow = mysqli_fetch_row($questionairyResult);
        	
        	$query = "SELECT Question FROM QuestionairyQuestions where Questionairy='".$questionairyRow[0]."'";
        	$questionResult = mysqli_query($this->db, $query);
        	
        	$count = 0;
        	while ($questionRow = mysqli_fetch_row($questionResult) ) {
        	
        		$query = "SELECT DISTINCT AnswerID from Answer where Question ='".$questionRow[0]."'";
        		$answerResult = mysqli_query($this->db, $query);
        			
        		if (mysqli_num_rows($answerResult) == '0') {
        			$query = "SELECT Answers FROM Result where SurveyID='".$surveyID."' and AnswerID is null";
        			$result = mysqli_query($this->db, $query);
        	
        			if (mysqli_num_rows($result) == '0') {
        				$answer[$count][] = 'null';
        			}
        			else {
        				while ($resultRow = mysqli_fetch_row($result) )
        					$answer[$count][] = $resultRow[0];
        			}
        		}
        		else {
        			while ($answerRow = mysqli_fetch_row($answerResult) ) {
        				$query = "SELECT COUNT(AnswerID) FROM Result where SurveyID='".$surveyID."' and AnswerID ='".$answerRow[0]."'";
        				$result = mysqli_query($this->db, $query);
        					
        				while ($resultRow = mysqli_fetch_row($result) )
        					$answer[$count][] = $resultRow[0];
        			}
        		}
        		$count++;
        	}
        	//mysqli_close($db);
        	
        	return $answer;
        } 
        public function getResultQuestions($surveyID) {
        	$questionText = null;
        	//$db = new mysqli('projekt.wi.fh-flensburg.de','projekt2016a','pkn_2404','projekt2016a','3306');
        
        	$query = "SELECT QuestionairyID FROM Survey where SurveyID = '".$surveyID."'";
        	$questionairyResult = mysqli_query($this->db, $query);
        	$questionairyRow = mysqli_fetch_row($questionairyResult);
        	
        	$query = "SELECT Question FROM QuestionairyQuestions where Questionairy='".$questionairyRow[0]."'";
        	$questionResult = mysqli_query($this->db, $query);
        
        	$count = 0;
        	while ($questionRow = mysqli_fetch_row($questionResult) ) {
        		$query = "Select Text FROM Question where QuestionID='".$questionRow[0]."'";
        		$result = mysqli_query($this->db, $query);
        			
        		$row = mysqli_fetch_row($result);
        			
        		$questionText[$count] = $row[0];
        			
        		$count++;
        	}
        	//mysqli_close($db);
        
        	return $questionText;
        }
        
        public function getAnswerText($surveyID) {
        	
        	$query = "SELECT QuestionairyID FROM Survey where SurveyID = '".$surveyID."'";
        	$questionairyResult = mysqli_query($this->db, $query);
        	$questionairyRow = mysqli_fetch_row($questionairyResult);
        	
        	$query = "SELECT Question FROM QuestionairyQuestions where Questionairy='".$questionairyRow[0]."'";
        	$questionResult = mysqli_query($this->db, $query);
        
        	$count = 0;
        	while ($questionRow = mysqli_fetch_row($questionResult) ) {
        
        		$query = "SELECT DISTINCT AnswerID FROM Answer where Question ='".$questionRow[0]."'";
        		$answerResult = mysqli_query($this->db, $query);
        
        		while ($answerRow = mysqli_fetch_row($answerResult) ) {
        			if (is_null($answerRow[0])) {
        				$answerText[$count][] = 'null';
        			}
        			else {
        				$query = "SELECT Text FROM Answer where AnswerID ='".$answerRow[0]."'";
        				$result = mysqli_query($this->db, $query);
        
        				while ($resultRow = mysqli_fetch_row($result) )
        					$answerText[$count][] = $resultRow[0];
        			}
        		}
        		$count++;
        	}
        	//mysqli_close($db);
        
        	return $answerText;
        }
    }
