<?php
    class registration{
        public $Title;
        public $FirstName;
        public $LastName;
        public $Password;
        public $Email;
        public $Username;
        public $IsValidated;
        public function __construct($Title,$FirstName,$LastName,$Password,$Email) {
            $this->Title = $Title;
            $this->FirstName = $FirstName;
            $this->LastName = $LastName;
            $this->Password = $Password;
            $this->Email = $Email;
            $this->IsValidated = FALSE;
            $this->createUserName();
        }
        private function createUserName(){
            mb_internal_encoding("UTF-8");            
            $firstname = mb_substr($this->FirstName, 0,2);
            $lastname = mb_substr($this->LastName, 0,2);
            $randomNumber = rand(1000,9999);
            $this->Username = $firstname.$lastname.$randomNumber;
        }
    }

