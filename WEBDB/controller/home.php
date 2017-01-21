<?php
require_once 'nav.php';
class home extends controller{
    private $nav;
    private $db;
        public function __construct() {
            $this->nav = new nav();
        }
        public function index(){
            $this->nav->index();
        }
        public function login(){
            // CheckInput  
            if($this->checkLogin()){
                $this->nav->questions();
            }
            else {
                $this->view('/home/login');
            }      
        }
        public function logout(){
            session_start();
            if(isset($_SESSION['User'])){
                session_destroy();
                $_SESSION = array();
            }
            $this->index();
        }
        public function resetLogin(){
            session_start();
            unset($_SESSION['EmailCheck']);
            $email = filter_input(INPUT_POST, 'Email');
            require_once 'core/database.php';
            $db = new DB();
            if($db->checkEmail($email)){
                require_once 'core/support.php';
                require_once 'core/mail.php';
                $support = new support();
                $newPassword = $support->randomPassword();
                if($db->resetPassword($email,md5($newPassword))){
                    $mail = new mail();
                    if($mail->sendPassword($email, $newPassword)){
                        $_SESSION['PasswordChanged'] = "Ihnen wurde ein neues Passwort zugesendet";
                        $this->nav->lostpw();
                    }
                }    
            }
            else{
                $_SESSION['EmailCheck'] = "E-Mail-Adresse nicht gefunden";
                $this->nav->lostpw();
            }
            $db->close();
        }
        public function register(){
            session_start();
            $registrationValid = true;           
            unset($_SESSION['FirstNameCheck']);
            unset($_SESSION['LastNameCheck']);
            unset($_SESSION['PasswordCheck']);
            unset($_SESSION['RepeatPasswordCheck']);
            unset($_SESSION['EmailCheck']);
            unset($_SESSION['RepeatEmailCheck']);
            unset($_SESSION['MailError']);
            unset($_SESSION['EmailPairCheck']);
            unset($_SESSION['PasswordPairCheck']);
            unset($_SESSION['EmailAlreadyUsed']);
            // 
            if(filter_input(INPUT_POST,'FirstName') == ""){
                $_SESSION['FirstNameCheck'] = 'Bitte Vornamen eingeben';
                $registrationValid = false;
            }
            if(filter_input(INPUT_POST,'LastName') == ""){
                $_SESSION['LastNameCheck'] = 'Bitte Nachnamen eingeben';
                $registrationValid = false;
            }
            if(filter_input(INPUT_POST,'Password') == ""){
                $_SESSION['PasswordCheck'] = 'Bitte Passwort eingeben';
                $registrationValid = false;
            }
            if(filter_input(INPUT_POST,'RepeatPassword') == ""){
                $_SESSION['RepeatPasswordCheck'] = 'Bitte Passwort erneut eingeben';
                $registrationValid = false;
            }
            if(!filter_var(filter_input(INPUT_POST, 'Email'),FILTER_VALIDATE_EMAIL)){
                $_SESSION['EmailCheck'] = "Bitte E-Mail-Adresse eingeben";
                $registrationValid = false;
            }
            if(!filter_var(filter_input(INPUT_POST, 'RepeatEmail'),FILTER_VALIDATE_EMAIL)){
                $_SESSION['RepeatEmailCheck'] = "Bitte E-Mail-Adresse wiederholen";
                $registrationValid = false;
            }
            if($this->checkMail($_POST['Email'])== true){
                $_SESSION['EmailAlreadyUsed'] = "Diese Email-Adresse wird bereits benutzt.";
                $registrationValid = false;
            }
            if($registrationValid == TRUE){
                if (filter_input(INPUT_POST, 'Email') != filter_input(INPUT_POST, 'RepeatEmail')){
                    $registrationValid = false;
                    $_SESSION['EmailPairCheck'] = "E-Mail-Adressen stimmen nicht überein!";
                }
                if (filter_input(INPUT_POST, 'Password') != filter_input(INPUT_POST, 'RepeatPassword')){
                    $registrationValid = false;
                    $_SESSION['PasswordPairCheck'] = "Passwörter stimmen nicht überein!";
                }
            }
            if($registrationValid == false){
                $this->view('/home/registration');
            }
            else{
                require_once 'models/registration.php';
                require_once 'core/database.php';
                $registration = new registration(filter_input(INPUT_POST,'Title'),
                                                 filter_input(INPUT_POST,'FirstName'), 
                                                 filter_input(INPUT_POST,'LastName'), 
                                                 md5(filter_input(INPUT_POST,'Password')), 
                                                 filter_input(INPUT_POST,'Email'));
                $db = new DB();
                if($db->insertRegistration($registration) == 'true'){
                    $db->close();
                    require_once 'core/mail.php';
                    $mail = new Mail();
                    if($mail->sendRegistration($registration) == true){
                        $this->view('/home/index');
                    } else {
                        $this->view('/home/registration');
                        
                    }
                }
                else{
                    $db->close();
                    $this-view('/home/registration');
                }
        }
    }               
        private function destroySession(){
            session_start();
            session_destroy();
            $_SESSION = array();
        }
        private function checkLogin(){
        session_start();
        unset($_SESSION['UsernameCheck']);
        unset($_SESSION['PasswordCheck']);
        unset($_SESSION['LoginValidation']);
        require_once 'models/user.php';
        $returnvalue = false;
        
        $username = filter_input(INPUT_POST,'Username');
        if($username == ""){
            $_SESSION['UsernameCheck'] = 'Bitte Benutzernamen eingeben';
        }
        $password = md5(filter_input(INPUT_POST,'Password'));
        if(filter_input(INPUT_POST,'Password') == ""){
            $_SESSION['PasswordCheck'] = 'Bitte Passwort eingeben';
        }
        if(filter_input(INPUT_POST,'Password') != "" && $username != ""){
            require_once 'core/database.php';
            $db = new DB();
            if($db->checkLogin($username,$password) == true){
                $model = new user($username);
                if($model->isValidated == 1){
                    $_SESSION['User'] = serialize($model);
                    $returnvalue = true;}
                else{
                    $_SESSION['LoginValidation'] = 'Ihr Account ist noch nicht freigegeben!';
                }
            }
            else{
                $_SESSION['LoginValidation'] = 'Ihre Login-Daten sind inkorrekt!';
            }
            $db->close();
        }
        return $returnvalue;
        }       
        private function checkMail($email){
            require_once 'core/database.php';
            $db = new DB();
            $result = $db->checkEmail($email);
            return $result;
        }
}
