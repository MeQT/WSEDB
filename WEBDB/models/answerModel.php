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
            $oldQID = $this->Question->QuestionID;
            if(isset($this->Question->QuestionID)){
                unset($this->Question->QuestionID);
                $questionid = $this->db->saveQuestion($this->Question);
                foreach ($this->Answers as $ans) {
                    unset($ans->AnswerID);
                    $ans->Question = $questionid;
                    $this->db->saveAnswer($ans);
                }
                $this->UpdateQuestionary($oldQID,$questionid); 
            $this->db->deleteQuestion($oldQID);
            }
            else{
                $questionid = $this->db->saveQuestion($this->Question);
                foreach ($this->Answers as $ans) {
                    $ans->Question = $questionid; //$questionid;
                    $this->db->saveAnswer($ans); 
                }
            }
            $this->db->close();
        }
        private function updateQuestionary($oldQID, $newQID){
            // machmal
        }
        public function close(){
            $this->db->close();
        }
    }
