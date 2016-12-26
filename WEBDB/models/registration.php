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
            $firstname = substr($this->FirstName, 0,2);
            $lastname = substr($this->LastName, 0,2);
            $this->Username = $firstname.$lastname;
        }
    }

