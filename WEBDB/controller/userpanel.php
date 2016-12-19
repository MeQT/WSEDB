<?php
    class userpanel extends controller{
        public function __construct() {
            session_start();
        }
    //<editor-fold defaultstate="visibile" desc="Navigation">
        public function index(){
            $this->view('header');
            $this->view('subheader');
            $this->view('/userpanel/index');
            $this->view('footer');
        }
        public function showQuestions(){
            $this->view('header');
            $this->view('subheader');
            $this->view('/userpanel/questions');
            $this->view('footer');
        }
        public function showQuestionairy(){
            $this->view('header');
            $this->view('subheader');
            $this->view('/userpanel/questionairy');
            $this->view('footer');
        }
        public function showAdminpanel(){
            $this->view('header');
            $this->view('subheader');
            $this->view('/userpanel/adminpanel');
            $this->view('footer');
        }
        public function showOptions(){
            $this->view('header');
            $this->view('subheader');
            $this->view('/userpanel/options');
            $this->view('footer');
        }
// </editor-fold>
    }
