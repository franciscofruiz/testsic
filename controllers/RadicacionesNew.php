<?php
      if( $_SESSION['logged_in']){
        $defaults = [
          'id' => '',
          'nombre_solicitante' => '',
          'fecha' => date('Y-m-d H:i:s'),
          'asunto' => '',
          'texto_solicitud' => '',
          'usuario_crea_id' => '',
          'usuario_edita_id' => ''
        ];
      }else{
        header('Location: index.php?action=login_failed&msg=Para acceder a esta seccion debe estar autenticado');  
      }
