<?php

class user{
    public $id;
    public $title;
    public $firstName;
    public $lastName;
    public $userName;
    public $eMail;
    public $isValidated = false;
    
    public function __construct($username) {
        $info = $this->getData($username);
    }
    private function getData($username){
        $output = array(8);
        $db = new mysqli('projekt.wi.fh-flensburg.de:3306','projekt2016a','pkn_2404','projekt2016a');
        $query = "SELECT * FROM person WHERE Username = '".$username."'";
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
                if($row['IsValidated'] == 1){
                    $this->isValidated = TRUE;}
                else{
                    $this->isValidated = FALSE;}
                
            }
        }
        // Model soll sich hier füllen
    }
}

