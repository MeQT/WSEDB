<?php
    require_once 'nav.php';
    require_once 'core/database.php';
    class surveyController extends controller{
        private $db;
        private $nav;
        public $Survey;
        public $Questionairy;
        public function __construct() {
            //$this->model = new surveyModel();
        }
        public function index(){
            
        }
        public function setup(){
            $id = filter_input(INPUT_POST, 'id_to_start');
            require_once 'models/questionaryModel.php';
            $this->db = new DB();
            $this->Questionairy = new questionairyModel();
            $this->Questionairy->loadData($id);
            $this->nav = new nav();
            $this->nav->setupSurvey(serialize($this->Questionairy));
        }
        public function start(){
            $this->nav = new nav();
            require_once 'models/questionaryModel.php';
            require_once 'models/questionairy.php';
            require_once 'models/surveyModel.php';
            require_once 'models/survey.php';
            require_once 'core/database.php';
            if (session_status() == PHP_SESSION_NONE) {
                @session_start();
            }
            require_once 'models/user.php';
            $user = unserialize($_SESSION['User']);
            
            $db = new DB();
                        
            $minutes = filter_input(INPUT_POST, 'time');
            $this->QuestionairyModel = base64_decode($_POST['model']);
            $this->Survey = new survey();
            
            $this->Survey->QuestionairyID = $this->QuestionairyModel;
            $this->Survey->Time = $minutes;
            $this->Survey->StartTime = new DateTime();
            $this->Survey->EndTime = new DateTime();
            $this->Survey->StartCode = $this->generateStartCode();
            $this->Survey->PersonID = $user->id;
            
            $id = $db->createSurvey($this->Survey);
            if(isset($id) & $id != -1){
                $this->Survey->SurveyID = $id;
                $this->nav->showSurveyInfos(serialize($this->Survey));
            }
            else{
                echo 'Ups hier geht was nicht';
            }
        }
        private function generateStartCode(){
            $result = rand(100000, 999999);
            $this->db = new DB();
            while($this->db->checkStartCode($result) == true){
                $result = rand(100000, 999999);
            }
            return $result;
        }
    }
