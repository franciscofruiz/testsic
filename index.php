<?php
## main app file
session_start();
include "config.php";
include ROOT_PATH.'/models/Usuario.php';
include ROOT_PATH.'/models/Radicacion.php';

//$Usuarios = Usuario::findAll();
/**
 echo password_hash('test2_123456', PASSWORD_DEFAULT);
*/

// routing
$default_view = 'index';
$action = ( isset( $_GET['action'] )  && $_GET['action'] != '' ) ? $_GET['action'] : $default_view;
// TODO: Improve session validation
switch ($action) {
  case 'login_validate':
    require_once ROOT_PATH.'/controllers/LoginValidate.php';
    break;
  case 'radicaciones':
      require_once ROOT_PATH.'/controllers/RadicacionesList.php';
    break;
  case 'radicaciones_edit':
      require_once ROOT_PATH.'/controllers/RadicacionesEdit.php';
    break;
  case 'radicaciones_new':
      require_once ROOT_PATH.'/controllers/RadicacionesNew.php';
    break;
  case 'radicaciones_save':
     if( $_SESSION['logged_in']){
        $data = $_POST['data'];
        Radicacion::create_or_update($data, $_SESSION['Usuario']);
        header('Location: index.php?action=radicaciones&msg=Registro almacenado con exito!');  
     }else{
        header('Location: index.php?action=login_failed&msg=Para acceder a esta seccion debe estar autenticado');  
      }
      break;
  case 'close_session':
      session_destroy();
      header('Location: index.php'); 
      break;
  default:
    // code...
    break;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Prueba SIC PHP</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="assets/css/application.css">
</head>
<body>
  <!-- header -->
  <div class="container">
  <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
    <a href="" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
      <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
      <span class="fs-4 h2">Prueba PHP SIC</span>
    </a>

    <ul class="nav nav-pills">
      <li class="nav-item"><a href="index.php" class="nav-link active" aria-current="page">Inicio</a></li>
      <?php if( !isset($_SESSION['logged_in'])): ?>
        <li class="nav-item"><a href="index.php?action=login" class="nav-link">Login</a></li>
      <?php endif; ?>
      <li class="nav-item"><a href="index.php?action=radicaciones" class="nav-link">Radicaciones</a></li>
      <?php if( isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
        <li class="nav-item"><a href="index.php?action=close_session" class="nav-link">Cerrar Session</a></li>
      <?php endif; ?>
    </ul>
  </header>
  </div>

  <div class="main_content">
    <?php include ROOT_PATH.'/views/'.$action.'.php'; ?>
  </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script type="text/javascript">
  $(document).ready( function () {
    $('#radicaciones').DataTable({
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json"
        },
         "order": [] // No sorting
      }
    );
  });
</script>
</body>
</html>