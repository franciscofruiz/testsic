<?php
$extra_msg = ( isset($_GET['msg']) ? $_GET['msg'] : '' );
?>
<script type="text/javascript">
  alert('Alerta, credenciales no válidas. <?= $extra_msg ?> ');
  window.location.href= 'index.php?action=login'
</script>