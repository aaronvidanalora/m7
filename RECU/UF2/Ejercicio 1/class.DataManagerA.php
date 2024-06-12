<?php

phpinfo();
class DataManager 
{
   private static function _getConnection() {
      static $hDB;
   
      if(isset($hDB)) {
         return $hDB;
      }
   
      $hDB = pg_connect("host=localhost port=5432 dbname=prova user=postgres  
                         password=postgres")
         or die("Failure connecting to the database!");
      return $hDB;
  }
 
   public static function getAddressData($addressID) {
      $sql = "SELECT * FROM \"entityaddress\" WHERE \"addressid\" = $addressID";
      $res = pg_query(DataManager::_getConnection(), $sql);
      if(! ($res && pg_num_rows($res))) {
         die("Failed getting address data for address $addressID");
      }
      return pg_fetch_assoc($res);
   }

   public static function getEmailData($emailID) {
      $sql = "SELECT * FROM \"entityemail\" WHERE \"emailid\" = $emailID";
      $res = pg_query(DataManager::_getConnection(), $sql);
   
      if(! ($res && pg_num_rows($res))) {
         die("Failed getting email data for email $emailID");
      }
   
      return pg_fetch_assoc($res);
   }

   public static function getPhoneNumberData($phoneID) {

      $sql = "SELECT * FROM \"entityphone\" WHERE \"phoneid\" = $phoneID";
      $res = pg_query(DataManager::_getConnection(), $sql);
      if(! ($res && pg_num_rows($res))) {
         die("Failed getting phone number data for phone $phoneID");
      }
   
      return pg_fetch_assoc($res);
   }
   
 
  public static function getEntityData($entityID) {
    $sql = "SELECT * FROM \"entities\" WHERE \"entityid\" = $entityID";
    $res = pg_query(DataManager::_getConnection(),$sql);
    if(! ($res && pg_num_rows($res))) {
      die("Failed getting entity $entityID");
    }
    return pg_fetch_assoc($res);
 }

   
}
?>
