<?php

require_once('class.DataManager.php');


$addressData = DataManager::getAddressData(1);
echo "<pre>";
print_r($addressData);
echo "</pre>";


$emailData = DataManager::getEmailData(1);
echo "<pre>";
print_r($emailData);
echo "</pre>";


$phoneData = DataManager::getPhoneNumberData(1);
echo "<pre>";
print_r($phoneData);
echo "</pre>";


$entityData = DataManager::getEntityData(1);
echo "<pre>";
print_r($entityData);
echo "</pre>";
?>