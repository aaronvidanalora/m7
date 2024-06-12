<?php

class Address {
    private $addressID;

    public function __construct($addressID) {
        $this->addressID = $addressID;
    }

    public function display() {
        echo "Address ID: " . $this->addressID;
    }
}