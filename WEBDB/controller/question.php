<?php
    require_once 'nav.php';
    require_once 'models/answerModel.php';
    class question extends controller{
        private $questionModel;
        private $answerModel;
        private $nav;
        public function __construct() {
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
            if(isset($_POST['QuestionID'])){
                $question->QuestionID = filter_input(INPUT_POST, 'QuestionID');
            }
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
                //print_r($_SESSION);
                $this->nav->addquestion($this->answerModel);
            }
        }
    }

