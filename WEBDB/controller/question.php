<?php
    require_once 'nav.php';
    require_once 'models/answerModel.php';
    require_once 'models/questionModel.php';
    class question extends controller{
        private $questionModel;
        private $answerModel;
        private $nav;
        public function __construct() {
            $this->questionModel = new questionModel();
            $this->answerModel = new answerModel();
            $this->nav = new nav();
        }
        public function index(){
            $this->view('/userpanel/addquestion', $this->answerModel);
        }
        public function addAnswer(){
            // only works for the first time - maybe instance problem?
            $this->answerModel->Count++;
            $this->view('/userpanel/addquestion', $this->answerModel);  
        }
        public function saveQuestion(){
            session_start();
            require_once 'core/database.php';
            require_once 'models/questions.php';
            require_once 'models/user.php';
            require_once 'models/answers.php';
            
            //method variables
            $validation = true;
            $isThereARightAnswer = false;
            $isthere = true;
            $question = new questions();
            $answer = new answers();
            $author = unserialize($_SESSION['User']);
            // unset Session
            unset($_SESSION['QuestionMissing']);
            unset($_SESSION['SelectionTypeMissing']);
            unset($_SESSION['AnswerMissing']);
            unset($_SESSION['QuestionAdded']);
            unset($_SESSION['TimeMissing']);
            unset($_SESSION['RightAnswerMissing']);
            // validation of input
            if(isset($_POST['SelectionType']) & filter_input(INPUT_POST,'SelectionType') != 9){
                if($_POST['SelectionType'] == 0){
                    $question->SelectionType = 0;
                }
                if($_POST['SelectionType'] == 1){
                    $question->SelectionType = 1;
                }
                if($_POST['SelectionType'] == 2){
                    $question->SelectionType = 2;
                }
            }
            else{
                $_SESSION['SelectionTypeMissing'] = "Bitte die Art der Frage auswählen";
                $validation = false;
            }
            if(isset($_POST['QuestionText']) & filter_input(INPUT_POST, 'QuestionText') != ""){
                $question->Text = filter_input(INPUT_POST, 'QuestionText');
            }
            else{
                $_SESSION['QuestionMissing'] = "Fällt ihnen vielleicht keine Frage ein?";
                $validation = false;
            }
            if(isset($_POST['Time']) & filter_input(INPUT_POST, 'Time') != 0){
                $question->Time = filter_input(INPUT_POST, 'Time');
            }
            else{
                $_SESSION['TimeMissing'] = "Zeit bitte angeben.";
                $validation = false;
            }
            // add question to model
            $question->Author = $author->id;
            $this->answerModel->Question = $question;
            
            // validate answers and add them to the model;
            for($i = 1; $isthere == true; $i++){
                if(isset($_POST['AnswerText'.$i]) & filter_input(INPUT_POST,'AnswerText'.$i) != ""){
                    $answer->Text = filter_input(INPUT_POST,'AnswerText'.$i);
                    $answer->Author = $author->id;
                    if(isset($_POST['RightOrWrong'.$i])){
                        $answer->IsRight = true;
                        $isThereARightAnswer = true;
                    }
                    else{
                        $answer->IsRight = false;
                    }
                    $this->answerModel->Answers[$i-1] = $answer;
                    $answer = new answers();
                }
                else{
                    if($i <=3){
                        $_SESSION['AnswerMissing'] = "Bitte Antwortmöglichkeiten angeben";
                    }
                    $isthere = false;
                }
            }
            if($isThereARightAnswer != TRUE){
                $validation = FALSE;
                $_SESSION['RightAnswerMissing'] = "Es gibt keine richtige Antwort.";
            }
            // overall validation
            // saving questions and answers
            // or sending back to questionmodel
            if($validation == TRUE){
                $this->answerModel->saveData();
                $_SESSION['QuestionAdded'] = "Frage erfolgreich gespeichert!";
                $this->nav->questions();
            }
            else{
                $this->nav->addq($this->answerModel);
            }
        }
        public function saveEditedQuestion(){
            require_once 'models/answerModel.php';
            require_once 'models/answers.php';
            require_once 'models/questions.php';
            session_start();
            $validation = true;
            $isThereARightAnswer = false;
            $isthere = true;
            unset($_SESSION['QuestionMissing']);
            unset($_SESSION['SelectionTypeMissing']);
            unset($_SESSION['AnswerMissing']);
            unset($_SESSION['QuestionAdded']);
            unset($_SESSION['TimeMissing']);
            unset($_SESSION['RightAnswerMissing']);
            
            if(isset($_POST['QuestionID'])){
                $questionid = $_POST['QuestionID'];
                $model = new answerModel();
                $model->loadData($questionid);
            }
            // validation of userinput
            // Question
            // validation of input
            if(isset($_POST['SelectionType']) & filter_input(INPUT_POST,'SelectionType') != 9){
                if($_POST['SelectionType'] == 0){
                    $model->Question->SelectionType = 0;
                }
                if($_POST['SelectionType'] == 1){
                    $model->Question->SelectionType = 1;
                }
                if($_POST['SelectionType'] == 2){
                    $model->Question->SelectionType = 2;
                }
            }
            else{
                $_SESSION['SelectionTypeMissing'] = "Bitte die Art der Frage auswählen";
                $model->Question->SelectionType = 9;
                $validation = false;
            }
            if(isset($_POST['QuestionText']) & filter_input(INPUT_POST, 'QuestionText') != ""){
                $model->Question->Text = filter_input(INPUT_POST, 'QuestionText');
            }
            else{
                $_SESSION['QuestionMissing'] = "Fällt ihnen vielleicht keine Frage ein?";
                unset($model->Question->Text);
                $validation = false;
            }
            if(isset($_POST['Time']) & filter_input(INPUT_POST, 'Time') != 0){
                $model->Question->Time = filter_input(INPUT_POST, 'Time');
            }
            else{
                $_SESSION['TimeMissing'] = "Zeit bitte angeben.";
                $model->Question->Time = 0;
                $validation = false;
            }
            for($i = 1; $isthere == true; $i++){
                if(isset($_POST['AnswerText'.$i])){
                    if(filter_input(INPUT_POST,'AnswerText'.$i) != ""){
                        if(isset($model->Answers[$i-1])){                    
                            $model->Answers[$i -1]->Text = filter_input(INPUT_POST,'AnswerText'.$i);
                            if(isset($_POST['RightOrWrong'.$i])){
                                $model->Answers[$i -1]->IsRight = true;
                                $isThereARightAnswer = true;
                            }
                            else{
                                $model->Answers[$i -1]->IsRight = false;
                            } 
                        }
                        else{
                            $answer = new answers();
                            $answer->Text = filter_input(INPUT_POST,'AnswerText'.$i);
                            $answer->Question = $model->Question->QuestionID;
                            $answer->Author = $model->Question->Author;
                            if(isset($_POST['RightOrWrong'.$i])){
                                $answer->IsRight = true;
                                $isThereARightAnswer = true;
                            }
                            else{
                                $answer->IsRight = false;
                            } 
                            $model->Answers[$i -1] = $answer;
                        }
                    }
                    else{
                        $model->Answers[$i -1]->Text = "";
                        $_SESSION['AnswerMissing'] = "Bitte Antwortmöglichkeiten angeben";
                        //$validation = false;
                    }
                }
                else{
                    if($i <=3){
                        $_SESSION['AnswerMissing'] = "Bitte Antwortmöglichkeiten angeben";
                    }
                    $isthere = false;
                }
            }
            if($isThereARightAnswer != TRUE){
                $validation = FALSE;
                $_SESSION['RightAnswerMissing'] = "Es gibt keine richtige Antwort.";
            }        
            if($validation == TRUE){
                $result = $model->saveChanges();
                if($result == TRUE){
                    $_SESSION['QuestionEdited'] = "Frage erfolgreich editiert!";
                    $this->nav->questions();
                }
                else{
                    $_SESSION['Fail'] = "Frage wurde nicht editiert";
                    $this->nav->editquestion(serialize($model));
                }
            }
            else{
                $this->nav->editquestion(serialize($model));
            }
        }
    }

