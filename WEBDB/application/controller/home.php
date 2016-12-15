<?php

class home extends controller{
        public function index(){
        $this->view('/header');
        $this->view('/home/index');
        $this->view('footer');
        }

        public function login(){
            // CheckInput
            $username = filter_input(INPUT_POST,'Username');
            $password = filter_input(INPUT_POST,'Password');
            
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
        $password = filter_input(INPUT_POST,'Password');
        $query = "SELECT * FROM Person WHERE Username ='".$username."' AND Password ='".$password."'";
        $db = new mysqli('projekt.wi.fh-flensburg.de:3306','projekt2016a','pkn_2404','projekt2016a');
        $result = $db->query($query);
        if($result->num_rows > 0){
            $model = new user($username);
            session_start();
            $_SESSION['User'] = $model;
            $returnvalue = true;
            }
        return $returnvalue;
        }     
        public function logout(){
            if(isset($_POST['User'])){
                session_destroy();
                $_SESSION = array();
            }
            $this->index();
        }
        public function register(){
            
        }
        public function resetLogin(){
            
        }
}
