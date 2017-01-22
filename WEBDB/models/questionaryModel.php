<?php
    require_once 'questionairy.php';
    require_once 'answerModel.php';
    require_once 'questions.php';
    require_once 'core/database.php';
    require_once 'course.php';
    class questionairyModel{
        public $Questionairy;
        public $Questions = array();
        public $OutQuestions = array();
        public $Courses = array();
        private $db;
        public function __construct() {
            $this->Questionairy = new questionairy();
        }
        public function loadData($id){
            $this->db = new DB();
            $this->Questionairy = $this->db->getQuestionairy($id);
            $this->Courses = $this->db->getCourses($this->Questionairy->Author);
            if(isset($this->Questionairy->QuestionairyID)){
                $this->Questions = $this->db->getQuestionairyQuestion($this->Questionairy->QuestionairyID);
                $this->OutQuestions = $this->db->getOutQuestionairyQuestion($this->Questionairy->QuestionairyID, $this->Questionairy->Author);        
            }
            $this->db->close();
        }
        public function saveData(){
            $this->db = new DB();
            if(isset($this->Questionairy->QuestionairyID)){
                $id = $this->Questionairy->QuestionairyID;
                $this->db->deleteQuestionairy($id);
                unset($this->Questionairy->QuestionairyID);
                if(($QuestionairyID = $this->db->saveQuestionaire($this->Questionairy)) != -1){
                    foreach ($this->Questions as $entry){
                        $this->db->saveQuestionairyQuestion($QuestionairyID,$entry->QuestionID);
                    }
                }
            }
            else{
                if(($QuestionairyID = $this->db->saveQuestionaire($this->Questionairy)) != -1){
                    foreach ($this->Questions as $entry){
                        $this->db->saveQuestionairyQuestion($QuestionairyID,$entry);
                    }
                }
                
            }
            
        }
        public function removeQuestionFromOutQuestion($id){
            for($i = 0; $i < count($this->OutQuestions);$i++){
                if($this->OutQuestions[$i]->QuestionID == $id){
                    $memory = $i;
                }
            }
            unset($this->OutQuestions[$memory]);
            sort($this->OutQuestions);
        }
        public function AddQuestionOntoOutQuestion($id){
            require_once 'models/questions.php';
            $this->db = new DB();
            $count = count($this->OutQuestions);
            if($count == 0){
                $this->OutQuestions = array();
                $this->OutQuestions[0] = $this->db->getQuestion($id);
            }else{
                $this->OutQuestions[$count] = $this->db->getQuestion($id);
            }
            
            $this->removeQuestionFromQuestionairy($id);
        }
        private function removeQuestionFromQuestionairy($id){
            for($i = 0; $i < count($this->Questions);$i++){
                if($this->Questions[$i]->QuestionID == $id){
                    $memory = $i;
                }
            }
            unset($this->Questions[$memory]);
            sort($this->Questions);
        }
    }
?>

