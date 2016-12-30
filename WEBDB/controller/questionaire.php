<?php
    require_once 'models/questionairy.php';
    require_once 'models/questionaryModel.php';
    require_once 'nav.php';
    class questionaire extends controller{
        public $model;
        private $nav;
        public function __construct() {
            $this->model = new questionairyModel();
            $this->nav = new nav();
        }
        public function index(){
            
        }
        public function saveQuestionary(){
            $validation = true;      
            $isthere = true;
            $isthereaquestion = false;
            $count = 0;
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            unset($_SESSION['TitleMissing']);
            unset($_SESSION['DescriptionMissing']);
            
            if(isset($_POST['Title']) && filter_input(INPUT_POST, 'Title') != ""){
                $this->model->Questionairy->Title = filter_input(INPUT_POST, 'Title');
            }
            else{
                $_SESSION['TitleMissing'] = "Bitte einen Titel für den Fragebogen angeben.";
                $validation = FALSE;
            }
            if(isset($_POST['Description']) && filter_input(INPUT_POST, 'Description') != ""){
                $this->model->Questionairy->Description = filter_input(INPUT_POST, 'Description');
            }
            else{
                $_SESSION['DescriptionMissing'] = "Bitte eine Beschreibung für den Fragebogen angeben.";
                $validation = FALSE;
            }
            for($i = 1; $isthere == TRUE; $i++){
                if(isset($_POST['QuestionToAdd'.$i])){
                    if(isset($_POST['AddQuestion'.$i])){
                        $this->model->Questions[$count++] = filter_input(INPUT_POST, 'QuestionToAdd'.$i);
                        $isthereaquestion == TRUE;
                    }
                }
                else{
                    $isthere = FALSE;
                }
            } 
            if($isthereaquestion == TRUE){
                if($validation == TRUE){
                    $this->model->saveData();
                    $this->nav->questionairies();
                }
                else {
                    $this->nav->addquestionairy();
                }
            }
            else{
                $this->nav->addquestionairy();
            }           
        }
    }

