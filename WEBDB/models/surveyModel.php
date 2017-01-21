<?php
    require_once 'survey.php';
    require_once 'questionaryModel.php';

    class surveyModel{
        public $QuestionairyModel;
        public $Survey;
        public function __construct() {
            $this->Survey = new survey();
            $this->QuestionairyModel = new questionairyModel();
        }
        public function loadData($questionairyModelID){
            require_once 'core/database.php';
            $db = new DB();
            $db->getQuestionairy($questionairyModelID);
            
        }
        public function saveData(){
            
        }
    }
