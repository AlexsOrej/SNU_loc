
<!-- <div class="card">  -->
<div class="body" style="align-content: center;" id="salidas">
  <table id="tablerot" class="table table-bordered">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Presentación</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <? foreach ($resultados as $value) : ?>
        <tr>
          <td><?= ucwords($value->nombre)  ?></td>
          <td><?= ucwords(utf8_encode($value->nombre_presentacion)) ?></td>
          <td>
            <a onclick="Salida('<?= $value->id ?>')" title="registrar salida de insumos"><i class="glyphicon glyphicon-export"></i></a>
            <a title="Historial salida de insumos"><i class="glyphicon glyphicon-tasks"></i></a>
          </td>
        </tr>
      <? endforeach; ?>
    </tbody>
  </table>
  <!-- </div> -->
</div>

<script>
  function Salida(id) {
    $.ajax({
      url: '?c=rotativos&a=kardex',
      data: {
        id: id
      },
      method: "POST",
      beforeSend: function() {
        $('#salidas').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
      },
      success: function(resp) {
        $('#salidas').html(resp);
      }
    })
  }
  $(document).ready(function() {});
</script>