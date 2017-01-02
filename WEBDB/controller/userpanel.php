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
        public function UpdatePassword(){        	
        	$updateValid = true;
        	unset($_SESSION['OldPasswordCheck']);
        	unset($_SESSION['NewPasswordCheck']);
        	unset($_SESSION['ConfirmPasswordCheck']);
        	unset($_SESSION['PasswordPairCheck']);
        	unset($_SESSION['UpdatePassword']);
        	
        	require_once 'core/database.php';
        	require_once 'models/user.php';
        	
        	$db = new DB();
        	$user = unserialize($_SESSION['User']);      	 	
        	
        	if(filter_input(INPUT_POST,'oldPassword') == ""){
        		$_SESSION['OldPasswordCheck'] = 'Bitte altes Passwort eingeben';
        		$updateValid = false;
        	}
        	else{
        		if ($db->validatePassword(md5(filter_input(INPUT_POST,'oldPassword'))) == FALSE)
        		{
        			$_SESSION['OldPasswordCheck'] = "Passwort ist nicht korrekt";
        			$updateValid = false;
        		}
        	}        	
        	if(filter_input(INPUT_POST,'newPassword') == ""){
        		$_SESSION['NewPasswordCheck'] = 'Bitte neues Passwort eingeben';
        		$updateValid = false;
        	}
        	if(filter_input(INPUT_POST,'confirmPassword') == ""){
        		$_SESSION['ConfirmPasswordCheck'] = 'Bitte neues Passwort wiederholen';
        		$updateValid = false;
        	}
        	if($updateValid == true){
        		
        		if (filter_input(INPUT_POST, 'newPassword') != filter_input(INPUT_POST, 'confirmPassword')){
        			$updateValid = false;
        			$_SESSION['PasswordPairCheck'] = "Passwörter stimmen nicht überein!";
        		}
        	}
        	if($updateValid == false){
        		$this->nav->options();
        	}
        	else{             		 
        		if ($db->updatePassword($user->id, md5(filter_input(INPUT_POST,'newPassword'))) == TRUE){
        			$_SESSION['UpdatePassword'] = 'Passwort erfolgreich geändert.';
        			
        			$db->close();        			
        			$this->view('userpanel/options');
        		}
        	}        	
        }
        public function UpdateEmail(){
        	$updateValid = true;
        	unset($_SESSION['EmailCheck']);
        	unset($_SESSION['UpdateEmail']);
        	
        	if(filter_input(INPUT_POST,'newEmail') == ""){
        		$_SESSION['EmailCheck'] = 'Bitte eine Email eingeben';
        		$updateValid = false;
        	}
        	if($updateValid == false){
        		$this->view('userpanel/options');
        	}
        	else{
        		require_once 'core/database.php'; 
        		require_once 'models/user.php';
        		
        		$db = new DB();
        		$user = unserialize($_SESSION['User']);
        		
        		
        		if ($db->updateEmail($user->id, filter_input(INPUT_POST,'newEmail')) == TRUE){
        			$_SESSION['UpdateEmail'] = 'Email erfolgreich geändert.';
        			 
        			$db->close();
        			$this->view('userpanel/options');
        		}
        	}
        }
    }
