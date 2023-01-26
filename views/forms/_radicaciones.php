<div class="container border">
  <form method="POST" action="index.php?action=radicaciones_save">
    <input name="data[id]" type="hidden" value="<?= $defaults['id']?>">
    <div class="mb-3">
      <label for="nombre_solicitante" class="form-label">Fecha:</label>
      <?= $defaults['fecha'] ?>
    </div>
    <div class="mb-3">
      <label for="nombre_solicitante" class="form-label">Nombre Solicitante:</label>
      <input type="text" class="form-control" name="data[nombre_solicitante]" id="nombre_solicitante" placeholder="Nombre Solicitante" maxlength="255" required="" value="<?= $defaults['nombre_solicitante'] ?>">
    </div>
    <div class="mb-3">
      <label for="asunto" class="form-label">Asunto:</label>
      <input type="text" class="form-control" name="data[asunto]" id="asunto" placeholder="Asunto" maxlength="255" required="" value="<?= $defaults['asunto'] ?>">
    </div>
    <div class="mb-3">
      <label for="texto_solicitud" class="form-label">Texto Solicitud:</label>
      <textarea class="form-control" id="texto_solicitud" name="data[texto_solicitud]" rows="3" required=""  maxlength="255" ><?= $defaults['texto_solicitud'] ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Guardar y Volver a la lista</button>
    <button type="reset" class="btn btn-secondary">Restablecer</button>
  </form>
</div>