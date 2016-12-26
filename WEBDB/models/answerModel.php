<?php
require_once 'questions.php';
require 'answers.php';
require_once 'core/database.php';
    class answerModel{
        private $db;
        public $Question;
        public $Answers = array();
        public $Count = 3;
        public function __construct() {
            $this->Question = new questions();
        }
        public function loadData($questionID){
            
        }
        public function saveData(){
            $this->db = new DB();
            $questionid = $this->db->saveQuestion($this->Question);
            foreach ($this->Answers as $ans) {
                $ans->Question = $questionid; //$questionid;
                $this->db->saveAnswer($ans);
            }
            $this->db->close();
        }
    }
