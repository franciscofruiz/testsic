<?php
session_start();
$email = $_POST['email'];
$password = $_POST['password'];
$Usuario = Usuario::findByEmail($email);

// validacion usuario
if($Usuario && password_verify($password, $Usuario->password) ){
  $_SESSION['logged_in'] = true;
  $_SESSION['Usuario'] = $Usuario;
  // Si es valido pero está inactivo, se envia mensaje
  if( !$Usuario->status){
    header('Location: index.php?action=login_failed&msg=Usuario inactivo');  
  }else{
    header('Location: index.php?action=login_success');  
  }
}else{
    if( isset( $_SESSION['last_email'] ) && $_SESSION['last_email'] == $email  ) {
      $_SESSION['intentos'] = $_SESSION['intentos']+1;
    }else{ // Primera vez que falla
      $_SESSION['last_email'] = $email;
      $_SESSION['intentos'] = 1;
    }
    // Si el correo digitado existe y tiene 3 intentos se inactiva
    $msg = "";
    if( $Usuario && $_SESSION['intentos'] >= 3 ){
      Usuario::updateStatusUsuario($Usuario,0);
      $msg = ". Se ha inactivado el usuario";
    }
    header('Location: index.php?action=login_failed&msg='.$msg);
}
