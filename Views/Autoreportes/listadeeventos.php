<?php //print_r($solicitudes) 
?>

<!-- <a href='?c=solicitudes&a=add' class="neu">Registrar Solicitud</a> -->
<div class="card">
    <div class="header text-center">
        <h2>LISTADO DE EVENTOS</h2>
    </div>
    <div class="body">
        <div class="sgcDocumentos index">
            <div class="table-responsive">
                <table id="table" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Clasificación Evento</th>
                            <th>Tipo Evento</th>
                            <th>Correccion Evento</th>
                            <!-- <th>Fecha registro</th> -->
                            <th>Menu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($leventos as $listaeventos) : ?>
                            <tr>
                                <td><?php echo ($listaeventos->id); ?>&nbsp;</td>
                                <td><?php echo ($listaeventos->clasificacionIncidente); ?>&nbsp;</td>
                                <td><?php echo ($listaeventos->tipoIncidente); ?>&nbsp;</td>
                                <td><?php echo ($listaeventos->correcionIncidente); ?>&nbsp;</td>
                                <!-- <td><?php echo ($listaeventos->fechaRegistro); ?>&nbsp;</td> -->
                                <td class="actions">
                                    <?php if ($_SESSION['user']->rol_id == 4 or $_SESSION['user']->rol_id == 1) : ?>
                                        <a href="?c=solicitudes&a=edit&id=<?php echo $sgcManejoDocumental->id ?>" type="button" title="Actualizar datos de la Solicitud">
                                            <i class="material-icons">edit</i>
                                        </a>
                                    <?php endif; ?>
                                    <?php if ($_SESSION['user']->rol_id == 4 or $_SESSION['user']->rol_id == 1) : ?>
                                        <a href="?c=solicitudes&a=edit&id=<?php echo $sgcManejoDocumental->id ?>" type="button" title="Actualizar datos de la Solicitud">
                                            <i class="material-icons">edit</i>
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- #END# CPU Usage -->
<div class="modal fade" id="modal-id">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body" id="index">

            </div>
        </div>
    </div>
</div>
<script>
    function Ver(id) {
        $.ajax({
            type: "POST",
            url: '?c=solicitudes&a=View',
            data: 'id=' + id,
            success: function(resp) {
                $('#index').html(resp);
                $('#respuesta').html("");
            }
        });
    }

    function Editar(id) {
        $.ajax({
            type: "POST",
            url: '?c=permisos&a=edit',
            data: 'id=' + id,
            success: function(resp) {
                $('#index').html(resp);
                $('#respuesta').html("");
            }
        });
    }
</script>