<?php

class home extends controller{
        public function index(){
        $this->view('/header');
        $this->view('/home/index');
        $this->view('footer');
        }

        public function login(){
            // CheckInput  
            if($this->checkLogin()){
                $this->view('header');
                $this->view('subheader');
                $this->view('/userpanel/index');
                $this->view('footer');
            }
            else {
                $this->view('header');
                $this->view('/home/login');
                $this->view('footer');
            }
            
        }
        public function checkLogin(){
        
        require_once '../application/models/user.php';
        $returnvalue = false;
        
        $username = filter_input(INPUT_POST,'Username');
        if($username == ""){
            echo 'Username bitte eingeben';
        }
        $password = filter_input(INPUT_POST,'Password');
        if($password == ""){
            echo 'Password bitte eingeben';
        }
        if($password != "" && $username != ""){
            $query = "SELECT * FROM Person WHERE Username ='".$username."' AND Password ='".$password."'";
            $db = new mysqli('projekt.wi.fh-flensburg.de:3306','projekt2016a','pkn_2404','projekt2016a');
            $result = $db->query($query);
            if($result->num_rows > 0){
                $model = new user($username);
                if($model->isValidated == 1){
                    session_start();
                    $_SESSION['Username'] = $model->firstName;
                    $_SESSION['User'] = $model;
                    $returnvalue = true;}
                else{
                    echo 'Ihr Account ist noch nicht freigegeben';
                }
            }
            else{
                echo 'Ihr Login scheint falsch zu sein';
            }
        }
        return $returnvalue;
        }     
        public function logout(){
            session_start();
            if(isset($_SESSION['Username'])){
                session_destroy();
                $_SESSION = array();
            }
            $this->index();
        }
        public function showRegister(){
            $this->view('header');
            $this->view('/home/registration');
            $this->view('footer');
        }
        public function showLogin(){
            $this->view('/header');
            $this->view('/home/login');
            $this->view('footer');
        }
        public function resetLogin(){
            
        }
        
        private function validation(){
            
        }
}
