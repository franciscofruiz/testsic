<?php
class Connection{
  static $connection;

  public static function do_connection(){
    //$connection = new mysqli("localhost","my_user","my_password","my_db");
    $connection = new mysqli(DB["servername"],DB['username'],DB['password'],DB['db_name']);
    // Check connection
    if ($connection -> connect_errno) {
      echo "Failed to connect to MySQL: " . $connection -> connect_error;
      exit();
    }
    self::$connection = $connection;
  }

  public static  function close_connection(){
   self::$connection->close();
  }

}
