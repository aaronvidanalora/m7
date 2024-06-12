<?php
class PhoneNumber {
    private $phoneID;

    public function __construct($phoneID) {
        $this->phoneID = $phoneID;
    }

    public function display() {
        echo "Phone ID: " . $this->phoneID;
    }
}