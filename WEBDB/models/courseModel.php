<?php
    require_once 'course.php';
    require_once 'core/database.php';
    class courseModel {
        public $Courses = array();
        private $db;
        public function __construct() {
            
        }
        public function loadData($author){
            $this->db = new DB();
            $this->Courses = $this->db->getCourses($authorID);
        }
        public function saveData(){
            $this->db = new DB();
        }
    }