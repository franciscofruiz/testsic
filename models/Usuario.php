<?php
require_once ROOT_PATH.'/models/AppModel.php';
/**
 * 
 */
class Usuario extends AppModel
{
  static $table_name = 'usuarios';
  
  function __construct()
  {
    // code...
  }

  public static function findAll(){
    self::do_connection();
    $q = "SELECT id, email, nombre, password, status
          FROM ".self::$table_name;
    $result = self::$connection->query($q);
    $data = [];
    while($row = $result->fetch_assoc()) {
      $data[] = (object)$row;
    }
    self::close_connection();
    return($data);
  }

  public static function findByEmail($email = ''){
    $Usuario = null;
    if($email != ''){
      self::do_connection();
      $q = "SELECT id, email, nombre, password, status
            FROM ".self::$table_name."
            WHERE email = '".$email."'";  
      $result = self::$connection->query($q);
      if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $Usuario = (object)$row;
      }
    }
    self::close_connection();
    return $Usuario;
  }

  public static function updateStatusUsuario($Usuario, $status = 0){
    self::do_connection();
    $q = "UPDATE ".self::$table_name."
          SET  status = ".$status."
          WHERE id = '".$Usuario->id."'";
    if (self::$connection->query($q) !== TRUE) {
      die("Error actualizando el registro: " . self::$connection->error);
    }
    self::close_connection();
  }


}