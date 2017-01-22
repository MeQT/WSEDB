<?php
    require_once 'models/questionaryModel.php';
    require_once 'models/survey.php';
    require_once 'models/studentsurvey.php';
    require_once 'core/database.php';
    require_once 'nav.php';
    // Controller for an active survey 
    class studentSurveyController extends controller{
        public $studentSurvey;
        private $db;
        private $nav;
        public function index(){
            
        }
        public function startQuiz(){
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            
            $this->nav = new nav();
            $code = filter_input(INPUT_POST, 'Quiznumber');
            // checkcode
            if(($validation = $this->validateSurvey($code)) != -1){
                if($validation > 0){
                    require_once 'models/survey.php';
                    $this->db = new DB();
                    $model = $this->db->getSurveyByCode($code);
                    $this->studentSurvey = new studentsurvey($model->SurveyID);
                    if(isset($_SESSION['QuizID']) && $_SESSION['QuizID'] == $this->studentSurvey->Survey->SurveyID){
                        $this->nav->studentSurveyError("Sie haben das Quiz schon beantwortet.");
                    }
                    else{
                        $this->nav->studentSurveyStart(serialize($this->studentSurvey));
                        $_SESSION['QuizID'] = $this->studentSurvey->Survey->SurveyID;
                    }
                }
                else{
                    $this->nav->studentSurveyError("Dieses Quiz ist bereits geschlossen.");
                    
                }
            }
            else{
                $this->nav->studentSurveyError("Bitte korrekten Quizcode eingeben.");
            }
            // get studentsurvey
            // show firstquestion
            
        }
        public function getNextAnswer(){
            require_once 'models/answerModel.php';
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }  
            if(isset($_POST['quiz'])){
                    $model = unserialize(base64_decode($_POST['quiz']));
                    if($model->Position < count($model->Questionairy->Questions)){
                        $answersModel = new answerModel();
                        $answersModel->loadData($model->Questionairy->Questions[$model->Position]->QuestionID);
                        $data = array ('Question' => $answersModel,'Survey' => $model);
                        $this->nav = new nav();
                        $this->nav->showQuestion(base64_encode(serialize($model)));
                    }
                    else{               
                        // session setzen um erneute teilnahme zu verhindern;
                        $this->nav = new nav();
                        $this->nav->EndQuiz();
                    }
            }
            else{
                
                $model = unserialize(base64_decode($_POST['QuizModel']));
                // save answer
                // selectiontype
                if($model->Questionairy->Questions[$model->Position]->SelectionType == 0){
                    for ($i = 0; $i < count($model->Answers);$i++){
                        if(isset($_POST['Answer'.$i])){
                            $aID = $_POST['hiddenAnswer'.$i];
                            $sID = $model->Survey->SurveyID;
                            $qID = $model->Questionairy->Questions[$model->Position]->QuestionID;
                            $this->db = new DB();
                            $this->db->saveSurveyAnswer($sID, $qID, $aID);
                        }
                    }
                }
                if($model->Questionairy->Questions[$model->Position]->SelectionType == 1){
                    if(isset($_POST['Answer'])){
                           $aID = $_POST['Answer'];
                           $sID = $model->Survey->SurveyID;
                           $qID = $model->Questionairy->Questions[$model->Position]->QuestionID;
                           $this->db = new DB();
                           $this->db->saveSurveyAnswer($sID, $qID, $aID);                        
                    }
                }
                if($model->Questionairy->Questions[$model->Position]->SelectionType == 2){
                    if(isset($_POST['FreeAnswer'])){
                       $sID = $model->Survey->SurveyID;
                       $answer = filter_input(INPUT_POST, 'FreeAnswer');
                       $questionID = $model->Questionairy->Questions[$model->Position]->QuestionID;
                       $this->db = new db();
                       $this->db->saveSurveyFreeAnswer($sID, $questionID, $answer);
                    }
                }
                
                $model->Position++;
                if($model->Position < count($model->Questionairy->Questions)){
                $answersModel = new answerModel();
                $answersModel->loadData($model->Questionairy->Questions[$model->Position]->QuestionID);
                $data = array ('Question' => $answersModel,'Survey' => $model);
                $this->nav = new nav();
                $this->nav->showQuestion(base64_encode(serialize($model)));
                }
                else{
                        // session setzen um erneute teilnahme zu verhindern;
                        $this->nav = new nav();
                        $this->nav->EndQuiz();
                }
            }
        }

        private function validateSurvey($code){
            require_once 'models/survey.php';
            $this->db = new DB();
            $model = $this->db->getSurveyByCode($code);
            if(isset($model)){
                $current = new DateTime();
                $endtime = $model->EndTime;
                return ($endtime->getTimestamp() - $current->getTimestamp());
            }
            else{
                return -1;
            }           
        }
        private function saveAnswer(){
            
        }
        
    }
