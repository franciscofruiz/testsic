<?php
require_once ROOT_PATH.'/models/AppModel.php';
/**
 * 
 */
class Radicacion extends AppModel
{
  static $table_name = 'radicaciones';
  
  function __construct()
  {
    // code...
  }

  public static function create_or_update($data, $CurrentUser){
    self::do_connection();
    //Edit record
    if( (int)$data['id'] >0 ){
      $id=$data['id'];
      unset($data['id']);
      $fields = [];
      foreach ($data as $key => $value) {
        $fields[] = $key.'="'.$value.'"';
      }
      $set = implode(',',$fields);
      $set = $set.",usuario_edita_id =".$CurrentUser->id;

      $q = "UPDATE ".self::$table_name."
            SET  ".$set."
            WHERE id = ".(int)$id."";
        if (self::$connection->query($q) !== TRUE) {
          die("Error updating record: " . self::$connection->error);
        }
    }else{ //New record
      unset($data['id']);
      $values = "'".implode("','", array_values($data))."'"; // transform array to 'value','value','value'

      $values = $values.','.$CurrentUser->id.','.$CurrentUser->id;
      $q = "INSERT INTO ".self::$table_name." (nombre_solicitante,asunto,texto_solicitud,usuario_crea_id,usuario_edita_id) VALUES 
            (".$values.")";
      if (self::$connection->query($q) !== TRUE) {
        die("Error Creando el registro: " . self::$connection->error); //TODO : Send message to user
      }
    }
    self::close_connection();
  }

  public static function findById($id){
    $Radicacion = null;
    if((int)$id >  0){
      self::do_connection();
      $q = "SELECT id, nombre_solicitante, fecha, asunto, texto_solicitud, usuario_crea_id, usuario_edita_id
            FROM ".self::$table_name."
            WHERE id = ".(int)$id."";  
      $result = self::$connection->query($q);
      if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $Radicacion = (object)$row;
      }
    }
    self::close_connection();
    return $Radicacion;
  }


  /**
   * @array params 
   *  fecha_inicial datetime 2023-01-26T16:27:46
   *  fecha_final datetime  2023-01-26T16:27:46
   *  nombre_solicitante string
   *  asunto string
   *  usuario_crea_id int
   * */
  public static function findAll($params = []){
    //var_dump($params);
    self::do_connection();
    $order = 'fecha desc';
    // No usados por ahora, se usó jquery.datatables  para sorting pagination
    //$limit = 25;
    //$offset = $page*25

    $conds = self::applyFilters($params);;
    $WHERE = ( count($conds) > 0  ) ? ' WHERE '.implode(' AND ', $conds) : '';

    $q = "SELECT ".self::$table_name.".id, ".self::$table_name.".nombre_solicitante, ".self::$table_name.".fecha, ".self::$table_name.".asunto,
                 ".self::$table_name.".texto_solicitud, ".self::$table_name.".usuario_crea_id, 
                 usuario_crea.nombre as usuario_crea_nombre, ".self::$table_name.".usuario_edita_id
        FROM ".self::$table_name." JOIN usuarios AS usuario_crea ON ".self::$table_name.".usuario_crea_id = usuario_crea.id 
        ".$WHERE."
        ORDER BY ".$order."
    ";
    $result = self::$connection->query($q);
    $data = [];
    while($row = $result->fetch_assoc()) {
      $data[] = (object)$row;
    }
    self::close_connection();
    return($data);
  }


  /********************************************************
   * applyFilters
   ************************************************************/
  public static function applyFilters($filters = []){
    $conds = [];
    if( isset($filters['fecha_inicial']) && $filters['fecha_inicial']!='' ){
      $conds[] = 'fecha >= "'.$filters['fecha_inicial'].'"';
    }
    if( isset($filters['fecha_final'])  && $filters['fecha_final']!='' ){
      $conds[] = 'fecha <= "'.$filters['fecha_final'].'"';
    }
    if( isset($filters['nombre_solicitante'])  && $filters['nombre_solicitante']!='' ){
      $conds[] = 'nombre_solicitante LIKE ("'.$filters['nombre_solicitante'].'%") ';
    }
    if( isset($filters['asunto'])  && $filters['asunto']!='' ){
      $conds[] = 'asunto LIKE ("'.$filters['asunto'].'%") ';
    }
    if( isset($filters['usuario_crea_id'])  && (int)$filters['usuario_crea_id']>0 ){
      $conds[] = 'usuario_crea_id = '.(int)$filters['usuario_crea_id'].' ';
    }
    return($conds);

  }

  /********************************************************
   * 
   ************************************************************/
  public static function findByEmail($email = ''){
    $Usuario = null;
    if($email != ''){
      self::do_connection();
      echo $q = "SELECT id, email, nombre, password, status
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


}