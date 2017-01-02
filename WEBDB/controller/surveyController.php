<?php
    require_once 'nav.php';
    require_once 'core/database.php';
    class surveyController extends controller{
        private $db;
        private $nav;
        public $model;
        public function __construct() {
            $this->model = new surveyModel();
        }
        public function index(){
            
        }
        public function start($id){
            require_once 'models/questionairy.php';
            $this->db = new DB();
            $questionairy = new questionairyModel();
            $this->model = $questionairy->loadData($id);
        }
        public function stop($id){
            
        }
        public function reset($id){
            
        }
        public function showResults($id){
            
        }
    }
