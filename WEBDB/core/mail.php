<?php
    require 'phpMailer/PHPMailerAutoload.php';
    class mail{

        private $mail;
        public function __construct() {
            $this->mail = new PHPMailer();
            $this->mail->isSMTP();
            $this->mail->CharSet = 'UTF-8';
            $this->mail->Host = 'smtp.gmail.com';
            $this->mail->SMTPAuth = true; 
            $this->mail->SMTPSecure = 'tls';
            $this->mail->Port = 587;
            $this->mail->Username = 'hsflprojekt2016a@gmail.com';
            $this->mail->Password = 'Kaffeesucht666';
            $this->mail->setFrom('hsflprojekt2016a@gmail.com', 'Projekt 2016 A');
            $this->mail->isHTML(true);
        }
        public function sendRegistration($registration){
            $message = "Hallo ".$registration->FirstName." ". $registration->LastName.", <br>
                        Sie haben sich erfolgreich bei Testimeter registriert.<br><br>
                        Ihre Benutzerkonto: ".$registration->Username."<br><br>
                        Ihr Zugang wird freigegeben sobald der Administrator Sie bestätigt hat.<br>
                        Sie werden per Email benachrichtigt, sobald dies geschehen ist.<br><br>
                        Viele Grüße";

            $this->mail->addAddress($registration->Email);
            $this->mail->addAddress("Christian-Wolff@Posteo.de");
            //$this->mail->addAddress("thomas.mueller@hs-flensburg.de");
            $this->mail->Subject = 'HS Flensburg Testimeter Registration erfolgreich.';
            $this->mail->Body    = $message;
            $this->mail->AltBody = $message;

            if(!$this->mail->send()) {
                return false;
            }           
            else {
                return true;
            }
        }
        public function sendPassword($email,$newPassword){
            $message = "Hallo,<br><br> Ihr Password wurde erfolgreich zurückgesetzt.<br>
                        Ihr neues Passwort lautet: ".$newPassword."<br><br>Viele Grüße";
            
            $this->mail->addAddress($email);
            $this->mail->Subject = 'HS Flensburg Testimeter Passwort zurückgesetzt.';
            // echter Text hier rein
            $this->mail->Body    = $message;
            $this->mail->AltBody = $message;

            if(!$this->mail->send()) {
                return false;
            }           
            else {
                return true;
            }
        }
        public function sendRegistrationAdmin(){
            $message = 'Hallo, <br><br>es liegt eine neue Registrierung im HS Flensburg Testimeter vor.<br> Der Benutzer wartet auf Ihre Bestätigung.<br><br><a href ="http://projekt.wi.fh-flensburg.de/~projekt2016a/">Hier gelangen sie zum Testimeter </a><br><br>Viele Grüße';
            $this->mail->addAddress("thomas.mueller@hs-flensburg.de");
            $this->mail->Subject = 'HS Flensburg Testimeter neue Registration.';
            // echter Text hier rein
            $this->mail->Body    = $message;
            $this->mail->AltBody = $message;

            if(!$this->mail->send()) {
                return false;
            }           
            else {
                return true;
            }
        }
        public function sendValidateUser($email, $userName) {
        	$message = "Hallo,<br><br> Sie wurden erfolgreich zugelassen.<br>
        				Sie können sich absofort einloggen.<br><br>Viele Grüße";
        	
        	$this->mail->addAddress($email);
        	$this->mail->Subject = 'HS Flensburg Testimeter Account "'.$userName.'" zugelassen.';
        	$this->mail->Body 	 = $message;
        	$this->mail->AltBody = $message;
        	
        	if(!$this->mail->send()) {
        		return false;
        	}
        	else {
        		return true;
        	}
        }
        public function sendUnValidateUser($email, $userName) {
        	$message = "Hallo,<br><br> Sie wurden gesperrt.<br>
        				Sie können sich absofort nicht mehr einloggen!<br><br>Viele Grüße";
        	 
        	$this->mail->addAddress($email);
        	$this->mail->Subject = 'HS Flensburg Testimeter Account "'.$userName.'" gesperrt.';
        	$this->mail->Body 	 = $message;
        	$this->mail->AltBody = $message;
        	 
        	if(!$this->mail->send()) {
        		return false;
        	}
        	else {
        		return true;
        	}
        }
        
    }

