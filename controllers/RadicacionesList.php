<?php
if( $_SESSION['logged_in']){
  $search_defaults = [
    'fecha_inicial' => (isset($_GET['fecha_inicial']) && $_GET['fecha_inicial'] != "" ) ? $_GET['fecha_inicial'] : '',
    'fecha_final'  => (isset($_GET['fecha_final']) && $_GET['fecha_final'] != "" ) ? $_GET['fecha_final'] : '',
    'nombre_solicitante' => (isset($_GET['nombre_solicitante']) && $_GET['nombre_solicitante'] != "" ) ? $_GET['nombre_solicitante'] : '',
    'asunto' =>  (isset($_GET['asunto']) && $_GET['asunto'] != "" ) ? $_GET['asunto'] : '',
    'usuario_crea_id' => (isset($_GET['usuario_crea_id']) && $_GET['usuario_crea_id'] != "" ) ? $_GET['usuario_crea_id'] : '', 
  ];
  $Usuarios = Usuario::findAll();
  $Radicaciones = Radicacion::findAll($_GET);
  
}else{
  header('Location: index.php?action=login_failed&msg=Para acceder a esta seccion debe estar autenticado');  
}
