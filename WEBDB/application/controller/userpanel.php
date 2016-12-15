<?php
    class userpanel extends controller{
        public function __construct() {
            
        }
        public function index(){
            $this->view('subheader');
            $this->view('/userpanel/index');
        }

        public function showQuestions(){
            $this->view('/userpanel/questions');
        }
        public function showQuestionairy(){
            $this->view('/userpanel/questionairy');
        }
        public function showAdminpanel(){
            $this->view('/userpanel/adminpanel');
        }
        public function showQuestionsPool(){
            $this->view('/userpanel/questionspool');
        }
        public function showQuestionariesPool(){
            $this->view('/userpanel/questionariespool');
        }
    }
