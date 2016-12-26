<?php
    require 'phpMailer/PHPMailerAutoload.php';
    class mail{

        private $mail;
        public function __construct() {
            $this->mail = new PHPMailer();
            $this->mail->isSMTP();
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
            $this->mail->addAddress($registration->Email);
            $this->mail->Subject = 'Registration erfolgreich!';
            // echter Text hier rein
            $this->mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            $this->mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            if(!$this->mail->send()) {
                return false;
            }           
            else {
                return true;
            }
        }
        public function sendPassword($email,$newPassword){
            $this->mail->addAddress($email);
            $this->mail->Subject = 'Ihr neues Passwort!';
            // echter Text hier rein
            $this->mail->Body    = 'Ihr neues Password lautet: '.$newPassword;
            $this->mail->AltBody = 'Ihr neues Password lautet: '.$newPassword;

            if(!$this->mail->send()) {
                return false;
            }           
            else {
                return true;
            }
        }
    }

