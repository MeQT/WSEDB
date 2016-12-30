<?php
    require_once 'nav.php';
    class userpanel extends controller{
        private $nav;
        public function __construct() {
            session_start();
            $this->nav = new nav();
        }
    //<editor-fold defaultstate="visibile" desc="Navigation">
        public function index(){
            $this->nav->questions();
        }
        public function deleteQuestion(){
            unset($_SESSION['DeleteComplete']);
            require_once 'core/database.php';
            $db = new DB();
            if(isset($_POST['id_to_delete'])){
                $id = filter_input(INPUT_POST, 'id_to_delete');
                if($db->deleteQuestion($id) == TRUE){
                    $_SESSION['DeleteComplete'] = "Frage wurde gelöscht.";
                }
            }
            $this->nav->questions();
        }
        public function editQuestion(){
            unset($_SESSION['EditComplete']);
            if(isset($_POST['id_to_edit'])){
                $id = filter_var($_POST['id_to_edit']);
            }
            require_once 'core/database.php';
            require_once 'models/answerModel.php';
            $model = new answerModel();
            $model->loadData($id);
            $this->nav->editquestion(serialize($model));
        }
// </editor-fold>
        
    }
