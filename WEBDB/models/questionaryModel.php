<?php
    require_once 'questionairy.php';
    require_once 'answerModel.php';
    require_once 'questions.php';
    require_once 'core/database.php';
    class questionairyModel{
        public $Questionairy;
        public $Questions = array();
        public $OutQuestions = array();
        private $db;
        public function __construct() {
            $this->Questionairy = new questionairy();
        }
        public function loadData($id){
            $this->db = new DB();
            $this->Questionairy = $this->db->getQuestionairy($id);
            if(isset($this->Questionairy->QuestionairyID)){
                $this->Questions = $this->db->getQuestionairyQuestion($this->Questionairy->QuestionairyID);
                $this->OutQuestions = $this->db->getOutQuestionairyQuestion($this->Questionairy->QuestionairyID, $this->Questionairy->Author);              
            }      
            
        }
        public function saveData(){
            $this->db = new DB();
            if(($QuestionairyID = $this->db->saveQuestionaire($this->Questionairy)) != -1){
                foreach ($this->Questions as $entry){
                    $this->db->saveQuestionairyQuestion($QuestionairyID,$entry);
                }
            }
        }
    }
?>

