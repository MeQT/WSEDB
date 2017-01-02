<?php
    // Here we will gather all nagivation operations
    class nav extends controller{
        public function index(){
            $this->view('/home/index');
        }
        public function help(){
            $this->view('/help/index');
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
        public function questionairies(){
            $this->view('/userpanel/questionairies');
        }
        public function options(){
        	require_once 'core/database.php';
        	require_once 'models/user.php';
        	$db = new DB();
        	$user = unserialize($_SESSION['User']);
        	$this->view('/userpanel/options');
        }
        public function adminpanel(){
        	require_once 'core/database.php';        	
        	$db = new DB();        	
            $this->view('/userpanel/adminpanel',$db->getUsers());
        }
        public function courses(){
            $this->view('/userpanel/course');
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
                $this->view('/userpanel/addquestionairy',$db->getQuestions($user->id));
            }
            else{
                $this->view('/userpanel/addquestionairy');
            }
        }
        private function destroySession(){
            session_start();
            session_destroy();
            $_SESSION = array();
        }
    }


