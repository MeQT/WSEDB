<?php
    require_once 'questionairy.php';
    require_once 'answerModel.php';
    require_once 'core/database.php';
    class questionairyModel{
        public $Questionairy;
        public $Questions = array();
        private $db;
        public function __construct() {
            $this->Questionairy = new questionairy();
        }
        public function loadData(){
            $this->db = new DB();
        }
        public function saveData(){
            $this->db = new DB();
        }
    }
?>

