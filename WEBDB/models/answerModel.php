<?php
require_once 'questions.php';
require 'answers.php';
require_once 'core/database.php';
    class answerModel{
        private $db;
        public $Question;
        public $Answers = array();
        public function __construct() {
            $this->Question = new questions();
        }
        public function loadData($questionID){
            $this->db = new DB();
            $this->Question = $this->db->getQuestion($questionID);
            $answers = array();
            $answers = $this->db->getAnswers($questionID);
            for($i = 0; $i < count($answers);$i++){
                $this->Answers[$i] = $answers[$i];
            }
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
        public function saveChanges(){
            $this->db = new DB();
            $insertA = false;
            $insertQ = $this->db->editQuestion($this->Question);
            if($insertQ == TRUE){

                foreach ($this->Answers as $entry)
                {
                    $insertA = $this->db->editAnswer($entry);
                }
            }
            return $insertA;
        }
        public function close(){
            $this->db->close();
        }
    }
