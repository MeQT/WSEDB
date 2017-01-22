<?php
    error_reporting(E_ALL & ~E_NOTICE);
    require_once 'models/questionairy.php';
    require_once 'models/questionaryModel.php';
    require_once 'nav.php';
    require_once 'core/database.php';
    class questionaire extends controller{
        public $model;
        private $nav;
        private $db;
        public function __construct() {
            $this->model = new questionairyModel();
            $this->nav = new nav();
        }
        public function index(){
            
        }
        public function deleteQuestionairy(){
            if(isset($_POST['id_to_delete'])){
                $id = filter_input(INPUT_POST, 'id_to_delete');
                $this->db = new DB();
                $this->db->deleteQuestionairy($id);
                $this->nav->questionairies();
            }
            
        }
        public function editQuestionairy(){
            require_once 'models/questionairy.php';
            require_once 'models/questionaryModel.php';
            if(isset($_POST['id_to_edit'])){
                $id = filter_input(INPUT_POST, 'id_to_edit');
                $model = new questionairyModel();
                $model->loadData($id);
                $this->view('/userpanel/editQuestionairy',$model);
            }
        }
        public function saveEditQuestionairy(){
            require_once 'models/questionaryModel.php';
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            if($_SESSION['QuestionairyIDAdded'] != $_POST['HiddenQuestionairyToSave'])
            {
                $model = unserialize(base64_decode($_POST['HiddenModel']));
                $validation = true;
                if(!empty($_POST['HiddenTitle'])){
                    $newTitle = filter_input(INPUT_POST, 'HiddenTitle');
                }
                else{
                    $_SESSION['NewTitleMissing'];
                    $validation = false;
                }
                if(!empty($_POST['HiddenDescription'])){
                    $newDescription = filter_input(INPUT_POST, 'HiddenDescription');
                }
                else{
                    $_SESSION['NewDescriptionMissing'];
                    $validation = false;
                }
                if($_POST['Course'] != 0){
                    $newCourse = filter_input(INPUT_POST, 'Course');
                }
                $model->Questionairy->QuestionairyID = $_POST['HiddenQuestionairyToSave'];
                $model->Questionairy->Title = $newTitle;
                $model->Questionairy->Description = $newDescription;
                if(isset($newCourse)){
                    $model->Questionairy->Course = $newCourse;
                }
                $model->saveData();

                if($validation){
                    $_SESSION['QuestionairyEdited'] = "Editierung erfolgreich.";
                    $_SESSION['QuestionairyIDAdded'] = $_POST['HiddenQuestionairyToSave'];
                    $this->nav->questionairies();
                }
                else{
                    $_SESSION['QuestionairyFailed'] = "Editierung nicht erfolgreich.";
                    $this->nav->editQuestionairy($model);
                }
            }else{
                unset($_SESSION['QuestionairyIDAdded']);
                $this->nav->questionairies();
            }
        }
        public function DelQuestion(){
            require_once 'models/questionaryModel.php';
            require_once 'core/database.php';
            require_once 'models/questions.php';
            $db = new DB();
            $model = new questionairyModel();
            $model->loadData($_POST['HiddenQuestionairyToDel']);
            $idToDel = filter_input(INPUT_POST, 'id_to_delete');
            $model->OutQuestionsQuestions[count($model->OutQuestions)] = $db->getQuestion($idToDel);
            $db->removeQuestionairyQuestion($model->Questionairy->QuestionairyID, $idToDel);
            $model->AddQuestionOntoOutQuestion($idToDel);
            $this->nav->editQuestionairy($model);
        }
        public function AddQuestion(){
            require_once 'models/questionaryModel.php';
            require_once 'core/database.php';
            require_once 'models/questions.php';
            $db = new DB();
            $model = new questionairyModel();
            $model->loadData($_POST['HiddenQuestionairyToAdd']);
            $idToAdd = filter_input(INPUT_POST, 'id_to_add');
            if(count($model->Questions) == 0){
                $model->Questions = array();
            }
            $model->Questions[count($model->Questions)] = $db->getQuestion($idToAdd);
            $db->saveQuestionairyQuestion($model->Questionairy->QuestionairyID, $idToAdd);
            $model->removeQuestionFromOutQuestion($idToAdd);
            $this->nav->editQuestionairy($model);
        }
        public function saveQuestionary(){
            $validation = true;      
            $isthere = true;
            $isthereaquestion = false;
            $count = 0;
            if (session_status() == PHP_SESSION_NONE) {
                @session_start();
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
            if(isset($_POST['Course']) && filter_input(INPUT_POST, 'Course') != 0){
                $this->model->Questionairy->Course = filter_input(INPUT_POST, 'Course');
            }
            else{
                $this->model->Questionairy->Course = 0;
            }
            for($i = 1; $isthere == TRUE; $i++){
                if(isset($_POST['QuestionToAdd'.$i])){
                    if(isset($_POST['AddQuestion'.$i])){
                        $this->model->Questions[$count++] = $_POST['QuestionToAdd'.$i];
                        $isthereaquestion = TRUE;
                    }
                }
                else{
                    $isthere = FALSE;
                }
            } 
            require_once 'models/user.php';
            $user = unserialize($_SESSION['User']);
            $this->model->Questionairy->Author = $user->id;
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

