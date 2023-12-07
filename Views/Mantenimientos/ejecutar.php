<div id="ejecuccion">
    <table id="tbl_ejecutar" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Elementos</th>
                <th>Sin Ejecutar</th>
                <th>Fecha De Ejecución</th>
                <th>Descripción</th>
                <th>Encargado</th>
                <th>Proveedor</th>
                <th>Menu</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mantenimientos as $value) :
                foreach ($indexPlanSinEjcutar as $val) :
                    if ($val->sinEjecutar > 0 and ($val->codigo == $value->codigo)) : ?>
                        <tr>
                            <td><?= $value->codigo ?></td>
                            <td> <a class="btn btn-primary" onclick="Elementos('<?= $value->codigo ?>')" data-toggle="modal" href='#modal-id'><?= $value->cantidad ?></a></td>
                            <td>
                                <?
                                if ($val->codigo == $value->codigo) {
                                    echo '<a class="btn btn-warning">' . $val->sinEjecutar . '</a>';
                                }
                                ?>
                            </td>
                            <td><?= $value->fecha ?></td>
                            <td class="text-justify"><?= utf8_encode($value->descripcion)  ?></td>
                            <td><?= utf8_encode($value->responsable) ?></td>
                            <td><?= utf8_encode($value->responsable_id) ?></td>
                            <td>
                                <a onclick="Editar('<?= $value->id ?>')" class=" btn-default" title="Editar datos de la planeación"> <i class="glyphicon glyphicon-edit"></i></a>
                                <a onclick="Ejecucion('<?= $value->codigo ?>')" class=" btn-default" title="Registre los datos correspondientes a la ejecución del mantenimiento"> <i class="glyphicon glyphicon-dashboard"></i></a>
                            </td>
                        </tr>
            <?php endif;
                endforeach;
            endforeach; ?>
        </tbody>
    </table>
</div>
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
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script>
    function Elementos(id) {
        // var id = document.getElementById("ubicacion").value
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

    function Ejecucion(id) {
        // var id = document.getElementById("ubicacion").value
        $.ajax({
            type: "POST",
            url: '?c=mantenimientos&a=crud',
            data: {
                id_mant: id
            },
            success: function(resp) {
                $('#ejecuccion').html(resp);
            }
        });
    }
</script>