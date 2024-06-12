<?php 
class EmailAddress {
    private $emailID;

    public function __construct($emailID) {
        $this->emailID = $emailID;
    }

    public function display() {
        echo "Email ID: " . $this->emailID;
    }
}