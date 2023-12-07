<?php //print_r($onlines)
?>
<style>
  .margen {
    margin-top: 20px;
    margin-right: 50px;
    margin-bottom: 20px;
    margin-left: 70px;
  }
</style>
<div class="panel">
  <div class="panel-heading">
    <h3 class="panel-title">
      <!-- <div class="text-right">
        Imprimir/Descargar
      </div> -->
    </h3>
  </div>
  <div class="panel-body margen">

    <table class="table table-bordered table-condensed">
      <tr>
        <td rowspan="2" width="10%">
          <p><img src="Assets/img/uploads/colegio/<?= $_SESSION['datos_cliente']->filename ?>" width="100%" height="auto" alt="User" /></p>
        </td>
        <th colspan="2" class="text-center">
          <p class="text-center"><?= strtoupper($onlines->NomDocumento) ?></p>
        </th>
        <th>
          <p class="text-center"><strong>Código:</strong> <?= ucwords($onlines->Codigo) ?></p>
        </th>
      </tr>
      <tr>
        <td>
          <p class="text-right"><strong>Fecha Vigencia:</strong></p>
        </td>
        <td>
          <p><?= $onlines->Actualizacion == "" ? $onlines->fecha_creacion : $onlines->fecha_creacion; ?></p>
        </td>
        <td>
          <p class="text-center"><strong>Version: </strong> <?= $onlines->Version ?></p>
        </td>
      </tr>
      <tr>
    </table>
    <div class="custom-div">
      <p>
        <?php echo $onlines->contenido; ?>
      </p>
    </div>
  </div>
</div>
<style>
  .custom-div {
    overflow: auto;
    display: contents;
    justify-content: center;
    align-items: center;
    height: 100vh;
    /* Ajusta la altura del div según tus necesidades */
  }

  p {
    text-align: justify;
    color: black
  }
</style>