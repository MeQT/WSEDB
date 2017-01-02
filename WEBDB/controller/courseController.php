<?php
require_once 'models/course.php';
require_once 'nav.php';
require_once 'core/database.php';
    class courseController extends controller{
        private $nav;
        private $db;
        public function __construct() {
            $this->nav = new nav();
        }
        public function index(){
            $this->nav->courses();
        }
        public function saveCourse(){
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }      
            unset($_SESSION['DescriptionMissing']);
            unset($_SESSION['ShortcutMissing']);
            $isNew = false;
            if(isset($_SESSION['LastCourse'])){
                if($_SESSION['LastCourse'] != $_POST['description']){
                    $isNew = true;
                    $course = $this->createNewCourse();
                }
            }
            else{
                $isNew = true;
                $course = $this->createNewCourse();
            }
            if($isNew){
                if($course != null){
                    $this->db = new DB();
                    $this->db->addCourse($course);
                    unset($this->db);
                    $this->nav->courses();
                    $_SESSION['LastCourse'] = $course->Text; 
                }
                else{
                    $this->nav->addCourse();
                }
            }
            else{
                $this->nav->addCourse();
            }
        }
        public function deleteCourse(){
            if(isset($_POST['id_to_delete'])){
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                $this->db = new DB();
                $id = filter_input(INPUT_POST, 'id_to_delete');
                if($this->db->deleteCourse($id)){
                    $_SESSION['CourseDelete'] = "Kurs erfolgreich entfernt.";
                }
                else{
                    $_SESSION['CourseDelete'] = "Aktion fehlgeschlagen.";
                }
                unset($this->db);
                $this->nav->courses();    
            }
        }
        public function editCourse(){
            if (session_status() == PHP_SESSION_NONE) {
                    session_start();
            }
            if(isset($_POST['hiddenid'])){
                $validation = true;
                $id = filter_input(INPUT_POST, 'hiddenid');
                $this->db = new DB();
                $course = $this->db->getCourse($id);
                if(isset($_POST['description'])){
                    $course->Text = filter_input(INPUT_POST, 'description');
                }
                else{
                    $validation = false;
                    $_SESSION['DescriptionMissing'] = "Neue Beschreibung ist fehlerhaft";
                }
                if(isset($_POST['shortcut'])){
                    $course->Shortcut = filter_input(INPUT_POST, 'shortcut');
                }
                else{
                    $validation = false;
                    $_SESSION['ShortcutMissing'] = "Neue Abkürzung ist fehlerhaft";
                }
                if($validation){
                    $_SESSION['CourseEdited'] = "Kurs erfolgreich editiert.";
                    $this->db = new DB();
                    $result = $this->db->editCourse($course);
                    
                    if($result == true){
                        $this->nav->courses();
                    }
                    else{
                        echo $result;
                    }
                }
                else{
                    $this->nav->editCourse();
                }
            }
            else{
                echo 'geht nicht';
                //$this->nav->courses();
            }
        }
        private function createNewCourse(){
            $validation = true;
            $newCourse = new course();
            if(isset($_POST['description']) & !empty($_POST['description'])){
                $newCourse->Text = filter_input(INPUT_POST, 'description');
            }
            else{
                $_SESSION['DescriptionMissing'] = "Name der Veranstaltung ist fehlerhaft.";
                $validation = false;
            }
            if(isset($_POST['shortcut']) & !empty($_POST['shortcut'])){
                $newCourse->Shortcut = filter_input(INPUT_POST, 'shortcut');
            }
            else{
                $_SESSION['ShortcutMissing'] = "Bitte geben sie ein Kürzel für ihre Veranstaltung an.";
                $validation = false;
            }
            require_once 'models/user.php';
            $user = unserialize($_SESSION['User']);
            $newCourse->Author = $user->id;
            if($validation){
                return $newCourse;
            }
            else{
                return null;
            }
        }
    }

