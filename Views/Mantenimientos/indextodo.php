<style>
    .rounded-pill {
        border-radius: 8px
    }
</style>
<table id="tbl_mantenimiento" class="table table-bordered table-responsive">
    <thead>
        <tr>
            <th>Codigo</th>
            <th>Elementos</th>
            <th>Descripcion</th>
            <th>Encargado</th>
            <th>Fecha</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($plan as  $value) : ?>
            <tr>
                <td><?= $value->codigo ?></td>
                <td style="vertical-align: middle;text-align: center;"> 
                <a title="Botón para ver los elementos del mantenimiento" class="btn btn-primary" onclick="Elementos('<?= $value->codigo ?>')" data-toggle="modal" href='#modal-id'>ver</a></td>
                <td style="text-align=justify" class="<?= $estado ?>"><?= utf8_encode($value->descripcion) ?></td>
                <td style="text-align=justify" class="<?= $estado ?>"><?= $value->responsable ?></td>
                <td style="text-align=justify" class="<?= $estado ?>"><?= $value->fecha ?></td>
                <td><?php

                    if ($value->est_solicitud == 'planeacion' and $value->est_ejecucion == '' and $value->est_verificacion == '') {
                        echo "<span class='label bg-blue-grey rounded-pill'>Planeado</span>";
                    }
                    if ($value->est_solicitud == 'planeacion' and $value->est_ejecucion == 'ejecucion' and $value->est_verificacion == '') {
                        echo "<span class='label bg-light-blue rounded-pill'>Ejecucion</span>";
                    }
                    if ($value->est_solicitud == 'planeacion' and $value->est_ejecucion == 'ejecucion' and $value->est_verificacion == 'verificacion') {
                        echo "<span class='label bg-green rounded-pill'>Verificado</span>";
                    }
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="modal fade" id="modal-id">
    <div class="modal-dialog">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body" id="result">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-orange" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script>
    function Elementos(id) {       
        $.ajax({
            type: "POST",
            url: '?c=mantenimientos&a=elementos',
            data: {
                codigo: id
            },
            success: function(resp) {
                $('#result').html(resp);
            }
        });
    }
 </script>