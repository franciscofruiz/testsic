<?php
//var_dump($Radicaciones);
?>
<div class="container">
  <div class="row">
    <h4 class="col-12 ">Radicaciones <a class="btn btn-outline-primary" href="index.php?action=radicaciones_new">Nueva radicación</a></h4>
 
  </div>
</div>
<div class="container mt-4 border">
  <div class="row">
    <h4 class="col-10 text-muted">Filtros de Busqueda</h4>
    <div class="col-2 text-right">
      <a class="btn btn-primary" href="index.php?action=radicaciones">Resetear filtros</a>
    </div>
  </div>
  
  <form action="index.php" method="get">
    <input type="hidden" name="action" value="radicaciones">
    <div class="input-group mb-3 row">
      <label class="input-group-text col-2" id="basic-addon1">Fecha Inicial</label>
      <input type="datetime-local" name="fecha_inicial" class="form-control col-4" placeholder="fecha inicial" value="<?= $search_defaults['fecha_inicial'] ?>">
      <label class="input-group-text col-2" id="basic-addon1">Fecha Final</label>
      <input type="datetime-local" name="fecha_final" class="form-control col-4" placeholder="fecha final"  value="<?= $search_defaults['fecha_final'] ?>">
    </div>

    <div class="input-group mb-3 row">
      <label class="input-group-text col-2" id="basic-addon1">Nombre Solicitante</label>
      <input type="text" name="nombre_solicitante" class="form-control col-2" placeholder="Nombre Solicitante" value="<?= $search_defaults['nombre_solicitante'] ?>">
      <label class="input-group-text col-1" id="basic-addon1">Asunto</label>
      <input type="text" name="asunto" class="form-control col-2" placeholder="Asunto"  value="<?= $search_defaults['asunto'] ?>" >
      <label class="input-group-text col-2" id="basic-addon1">Usuario Creó</label>
      <select class="col-2" name="usuario_crea_id">
        <option>Usuario que creó la solicitud</option>
        <?php foreach ($Usuarios as $key => $Usuario): ?>
            <?php $selected = ($Usuario->id == $search_defaults['usuario_crea_id']) ? 'selected': ''; ?>
            <option value="<?= $Usuario->id ?>" <?= $selected ?>><?= $Usuario->nombre ?></option>
        <?php endforeach ?>
      </select>
      <button type="submit" class="col-1 btn btn-primary m-1">Filtrar</button>
    </div>

  </form>
</div>

<?php if(isset($_GET['msg']) && $_GET['msg'] != ''): ?>
  <div class="container">
    <div class="alert alert-warning" role="alert">
      <?=  $_GET['msg'] ?>
    </div>
  </div>
<?php endif; ?>

<!-- List -->
<div class="container mt-4">
<table id="radicaciones" class="display" style="width:100%" data-page-length='25' data-searching="false">
        <thead>
            <tr>
                <th>id</th>
                <th>nombre_solicitante</th>
                <th>fecha</th>
                <th>asunto</th>
                <th>texto_solicitud</th>
                <th>Usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
          <?php foreach ($Radicaciones as $key => $Radicacion): 
            $Radicacion = (object)$Radicacion;
            ?>
              <tr>
                  <td><?= $Radicacion->id ?></td>
                  <td><?= $Radicacion->nombre_solicitante ?></td>
                  <td><?= $Radicacion->fecha ?></td>
                  <td><?= $Radicacion->asunto ?></td>
                  <td><?= $Radicacion->texto_solicitud ?></td>
                  <td><?= $Radicacion->usuario_crea_nombre ?></td>
                  <td><a href="index.php?action=radicaciones_edit&id=<?= $Radicacion->id ?>" class="btn btn-success">Editar</a> </td>
              </tr>
          <?php endforeach ?>
        </tbody>
        <tfoot>
            <tr>
                <th>id</th>
                <th>nombre_solicitante</th>
                <th>fecha</th>
                <th>asunto</th>
                <th>texto_solicitud</th>
                <th>Usuario</th>
                <th>Acciones</th>
            </tr>
        </tfoot>
    </table>
    </div>