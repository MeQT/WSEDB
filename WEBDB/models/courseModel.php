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
            $this->Courses = $this->db->getCourses($author);
        }
        public function saveData(){
            $this->db = new DB();
            foreach ($this->Courses as $entry){
                if(!isset($entry->CourseID)){
                    $newID = $this->db->addCourse($entry);
                    if($newID != -1){
                        $entry->CourseID = $newID;
                    }
                }
            }
        }
        public function removeCourse($id){
            $this->db = new DB();
            if($id != -1){
                $this->db->deleteCourse($id);
            }
        }
    }