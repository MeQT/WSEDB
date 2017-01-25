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
				$_SESSION['DeleteUser'] = 'Benutzer erfolgreich gelöscht.';
			}
		}
		$this->nav->adminpanel();		
	}
	public function validateUser(){
		unset($_SESSION['ValidateUser']);		
		require_once 'core/database.php';
		$db = new DB();
		if (isset($_POST['personID'])){		
			require_once 'core/mail.php';
			require_once 'models/user.php';
			$mail = new mail();
			$user = new user($_POST['personID']);
			if ($db->validateUser($_POST['personID']) == 0){
				$_SESSION['ValidateUser'] = "Benutzer erfolgreich gesperrt.";
				$mail->sendUnValidateUser($db->getEmail($_POST['personID']), $db->getUserName($_POST['personID']));
				
			}
			else {
				$_SESSION['ValidateUser'] = "Benutzer erfolgreich zugelassen.";
				$mail->sendValidateUser($db->getEmail($_POST['personID']), $db->getUserName($_POST['personID']));
			}
		}
		$this->nav->adminpanel();
	}
}