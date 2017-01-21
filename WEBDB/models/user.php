<?php
class user{
    public $id;
    public $title;
    public $firstName;
    public $lastName;
    public $userName;
    public $eMail;
    public $isValidated = 0;
    public $isAdmin;
    
    public function __construct($username) {
        $this->getData($username);
    }
    private function getData($username){
        require_once 'core/database.php';
        $db = new DB();
        $userinfos = $db->getUser($username);
                            $this->id = $userinfos['PersonID'];
                    $this->title = $userinfos['Title'];
                    $this->firstName = $userinfos['FirstName'];
                    $this->lastName = $userinfos['LastName'];
                    $this->username = $userinfos['Username'];
                    $this->eMail = $userinfos['Email'];
                    $this->isValidated = $userinfos['IsValidated'];
    }
}