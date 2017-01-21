<?php
    require_once 'models/questionaryModel.php';
    require_once 'models/survey.php';
    require_once 'core/database.php';
    require_once 'models/questions.php';
    class studentsurvey{
        public $Questionairy;
        public $Survey;
        public $Position = 0;
        public $Answers = array();
        private $db;
        public function __construct($surveyID) {
            $this->db = new DB();
            $this->Survey = $this->db->getSurvey($surveyID);
            
            $this->Questionairy = new questionairyModel();
            $this->Questionairy->loadData($this->Survey->QuestionairyID); 
            $this->Answers = $this->loadAnswers($this->Questionairy->Questions);
        }
        private function loadAnswers($questions){
            $output = array();
            $i = 0;
            foreach ($questions as $question) {
                $output[$i++] = $this->db->getAnswers($question->QuestionID);
            }
            return $output;
        }
    }

