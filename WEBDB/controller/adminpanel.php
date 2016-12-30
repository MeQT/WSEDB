<?php
    require_once 'nav.php';
    class adminpanel extends controller{
        private $nav;
        public function __construct() {
            session_start();
            $this->nav = new nav();
        }
	public function deleteUser(){

		unset($_SESSION['DeleteUser']);
		require_once 'core/database.php';
		$db = new DB();		
		if (isset($_POST['personID'])){			
			if ($db->deleteUser($_POST['personID']) == TRUE){
				$_SESSION['DeleteUser'] = 'User erfolgreich gelöscht.';
			}
		}
		$this->nav->adminpanel();		
	}
	public function validateUser(){
		unset($_SESSION['ValidateUser']);		
		require_once 'core/database.php';
		$db = new DB();
		if (isset($_POST['personID'])){			
			if ($db->validateUser($_POST['personID']) == 0){
				$_SESSION['ValidateUser'] = "User erfolgreich gesperrt.";				
			}
			else {
				$_SESSION['ValidateUser'] = "User erfolgreich zugelassen.";
			}
		}
		$this->nav->adminpanel();
	}
}