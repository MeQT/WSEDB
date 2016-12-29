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
        $db = new mysqli('projekt.wi.fh-flensburg.de','projekt2016a','pkn_2404','projekt2016a','3306');
        $query = "SELECT * FROM Person WHERE Username = '".$username."'";
        $result = $db->query($query);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc())
            {
                $this->id = $row['PersonID'];
                $this->title = $row['Title'];
                $this->firstName = $row['FirstName'];
                $this->lastName = $row['LastName'];
                $this->username = $row['Username'];
                $this->eMail = $row['Email'];
                $this->isValidated = $row['IsValidated'];
            }
        }
        $db->close();
    }
}