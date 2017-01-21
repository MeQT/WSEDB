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
            $this->nav = new nav();
            $code = filter_input(INPUT_POST, 'Quiznumber');
            // checkcode
            if(($validation = $this->validateSurvey($code)) != -1){
                if($validation > 0){
                    require_once 'models/survey.php';
                    $this->db = new DB();
                    $model = $this->db->getSurveyByCode($code);
                    $this->studentSurvey = new studentsurvey($model->SurveyID);
                    $this->nav->studentSurveyStart(serialize($this->studentSurvey));
                }
                else{
                    $message = "Survey finished";
                }
            }
            else{
                $message = "Code invalid";
            }
            // get studentsurvey
            // show firstquestion
            
        }
        public function getNextAnswer(){
            require_once 'models/answerModel.php';
            $model = unserialize(base64_decode($_POST['quiz']));
            $position = $model->Position++;
            $answersModel = new answerModel();
            $answersModel->loadData($model->Questionairy->Questions[$model->Position]->QuestionID);
            $data = array ('Question' => $answersModel,'Survey' => $model);
            $this->nav = new nav();
            $this->nav->showQuestion(base64_encode(serialize($model)));
        }
        public function start(){
            require_once 'models/answerModel.php';
            $model = unserialize(base64_decode($_POST['quiz']));
            $position = $model->Position++;
            $answersModel = new answerModel();
            $answersModel->loadData($model->Questionairy->Questions[$model->Position]->QuestionID);
            $data = array ('Question' => $answersModel,'Survey' => $model);
            $this->nav = new nav();
            $this->nav->showQuestion(base64_encode(serialize($model)));
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
