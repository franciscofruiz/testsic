<?php
      if( $_SESSION['logged_in']){
        //TODO: Valid ids
        $Radicacion = Radicacion::findById($_GET['id']);
        $defaults = [
          'id' => $Radicacion->id,
          'nombre_solicitante' => $Radicacion->nombre_solicitante,
          'fecha' => $Radicacion->fecha,
          'asunto' => $Radicacion->asunto,
          'texto_solicitud' => $Radicacion->texto_solicitud,
          'usuario_crea_id' => $Radicacion->usuario_crea_id,
          'usuario_edita_id' => $Radicacion->usuario_edita_id,
        ];
      }else{
        header('Location: index.php?action=login_failed&msg=Para acceder a esta seccion debe estar autenticado');  
      }
