<?php
    require_once 'nav.php';
    class adminpanel extends controller{
        private $nav;
        public function __construct() {
            session_start();
            $this->nav = new nav();
        }
	public function deleteUser(){
		if (isset($_POST['personID'])){
			require_once 'core/database.php';
			$db = new DB();
			$db->deleteUser($_POST['personID']);

			$this->nav->adminpanel();
		}
		else{
			$db->close();
			$this->nav->adminpanel();
		}
	}
	public function validateUser(){
		if (isset($_POST['personID'])){
			require_once 'core/database.php';
			$db = new DB();
			$db->validateUser($_POST['personID']);

			$this->nav->adminpanel();
		}
		else{
			$db->close();
			$this->nav->adminpanel();
		}
	}
}