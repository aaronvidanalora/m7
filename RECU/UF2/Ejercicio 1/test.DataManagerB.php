<?php
require_once('class.DataManagerB.php');

$entityID = 1;

// Test getAddressObjectsForEntity
$addresses = DataManager::getAddressObjectsForEntity($entityID);
echo "<h2>Address Objects for Entity $entityID</h2>";
foreach ($addresses as $address) {
    $address->display();
    echo "<br>";
}

// Test getEmailObjectsForEntity
$emails = DataManager::getEmailObjectsForEntity($entityID);
echo "<h2>Email Objects for Entity $entityID</h2>";
foreach ($emails as $email) {
    $email->display();
    echo "<br>";
}

// Test getPhoneNumberObjectsForEntity
$phones = DataManager::getPhoneNumberObjectsForEntity($entityID);
echo "<h2>Phone Objects for Entity $entityID</h2>";
foreach ($phones as $phone) {
    $phone->display();
    echo "<br>";
}
?>