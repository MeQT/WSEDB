<?php
    // Here we will gather all nagivation operations
    class nav extends controller{
        public function index(){
            $this->view('/home/index');
        }
           
        public function helpAllgemeineNutzungshinweise(){
            $this->view('/help/AllgemeineNutzungshinweise');
        }
        
        public function helpRegistrierung(){
            $this->view('/help/Registrierung');
        }
        
        public function helpAnmeldung(){
            $this->view('/help/Anmeldung');
        }
        
        public function helpPasswortVergessen(){
            $this->view('/help/PasswortVergessen');
        }
        
        public function helpFragen(){
            $this->view('/help/Fragen');
        }
        
        public function helpKurse(){
            $this->view('/help/Kurse');
        }
        
        public function helpFrageboegen(){
            $this->view('/help/Frageboegen');
        }
        
        public function helpUmfragen(){
            $this->view('/help/Umfragen');
        }
        
        public function helpAdministration(){
            $this->view('/help/Administration');
        }
        
        public function helpEinstellungen(){
            $this->view('/help/Einstellungen');
        }
        
        public function helpImpressum(){
            $this->view('/help/Impressum');
        }
        
        public function registration(){
            $this->destroySession();
            $this->view('/home/registration');
        }
        public function login(){
            $this->view('/home/login');
        }
        public function lostpw(){
            $this->view('/home/lostpassword');
        }
        public function questions(){
            require_once 'core/database.php';
            require_once 'models/user.php';
            if (session_status() == PHP_SESSION_NONE) {
            session_start();
            }
            if(isset($_SESSION['User'])){
                $user = unserialize($_SESSION['User']);
                $db = new DB();
                $this->view('/userpanel/questions',$db->getQuestions($user->id));
            }
            else{
                $this->view('/userpanel/questions');
            }
        }
        public function addquestion($data){
            $this->view('/userpanel/addquestion',$data);
        }
        public function editquestion($model){
            $this->view('/userpanel/editquestion',$model);
        }
        public function savequestionandmore(){
            
        }
        public function questionairies(){
            require_once 'core/database.php';
            require_once 'models/user.php';
            require_once 'models/questionairy.php';
            require_once 'models/course.php';
            if (session_status() == PHP_SESSION_NONE) {
            session_start();
            }
            if(isset($_SESSION['User'])){
                $user = unserialize($_SESSION['User']);
                $db = new DB();
                $questionairies = $db->getQuestionairies($user->id);
                if($questionairies != -1){
                    foreach ($questionairies as $entry) {
                        $id = $entry->Course;
                        $course = $db->getCourse($id);
                        if(isset($course->Shortcut)){
                            $entry->CourseName = $course->Shortcut;
                        }
                        else{
                            $entry->CourseName = "";
                        }
                    }
                }
                
                
                $this->view('/userpanel/questionairies',$questionairies);
            }
            else{
                $this->view('/userpanel/questionairies');
            }            
        }
        public function options(){
        	require_once 'core/database.php';
        	require_once 'models/user.php';
        	$db = new DB();
        	//$user = unserialize($_SESSION['User']);
        	$this->view('/userpanel/options');
        }
        public function adminpanel(){
        	require_once 'core/database.php';        	
        	$db = new DB();        	
            $this->view('/userpanel/adminpanel',$db->getUsers());
        }
        public function courses(){
            require_once 'core/database.php';
            require_once 'models/courseModel.php';
            require_once 'models/user.php';
            if (session_status() == PHP_SESSION_NONE) {
            session_start();
            }
            if(isset($_SESSION['User'])){
                $db = new DB();
                $user = unserialize($_SESSION['User']);
                $model = new courseModel();
                $model->loadData($user->id);
                $this->view('/userpanel/course', $model);
            }
            else{
                $this->view('/userpanel/course');
            }
           
        }
        public function addquestionairy(){
            require_once 'core/database.php';
            require_once 'models/user.php';
            if (session_status() == PHP_SESSION_NONE) {
            session_start();
            }
            if(isset($_SESSION['User'])){
                $user = unserialize($_SESSION['User']);
                $db = new DB();
                $data = array();
                $data[0] = $db->getQuestions($user->id);
                $data[1] = $db->getCourses($user->id);
                $this->view('/userpanel/addquestionairy', $data);
            }
            else{
                $this->view('/userpanel/addquestionairy');
            }
        }
        public function editQuestionairy($model){
            $this->view('/userpanel/editQuestionairy',$model);
        }
        public function addCourse(){
            $this->view('userpanel/addcourse');
        }
        public function editCourse(){
            require_once 'core/database.php';
            require_once 'models/course.php';
            $id = filter_input(INPUT_POST, 'id_to_edit');
            $db = new DB();
            $course = $db->getCourse($id);
            $this->view('/userpanel/editcourse', serialize($course));
        }
        public function showSurveys(){
            $this->view('userpanel/survey');
        }
        public function startSurvey(){
            $this->view('userpanel/activesurvey');
        }
        public function setupSurvey($model){
            $this->view('userpanel/survey', $model);
        }
        public function showSurveyInfos($model){
            $this->view('userpanel/surveyinfos', $model);
        }
        public function showSurveyOverview(){
            require_once 'core/database.php';
            $this->db = new DB();
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            require_once 'models/user.php';
            $user = unserialize($_SESSION['User']);
            $result = $this->db->getSurveys($user->id);
            $this->view('userpanel/surveyoverview', serialize($result));
        }
        public function studentSurveyStart($model){
            $this->view('survey/start',$model);
        }
        public function showQuestion($model){
            $this->view('survey/answer',$model);
        }
        public function EndQuiz(){
            $this->view('survey/end');
        }
        public function studentSurveyError($message){
            $this->view('survey/error',$message);
        }
        private function destroySession(){
            session_start();
            session_destroy();
            $_SESSION = array();
        }
    }


